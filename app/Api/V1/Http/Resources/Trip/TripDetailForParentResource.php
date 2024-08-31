<?php

namespace App\Api\V1\Http\Resources\Trip;

use App\Admin\Repositories\ScheduleOff\ScheduleOffRepositoryInterface;
use App\Api\V1\Http\Resources\TripDetail\TripDetailNotStudentResource;
use App\Api\V1\Http\Resources\TripDetail\TripDetailResource;
use App\Api\V1\Repositories\Trip\TripRepositoryInterface;
use App\Api\V1\Support\AuthServiceApi;
use App\Enums\Contract\ContractType;
use App\Enums\Trip\PickupStatus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TripDetailForParentResource extends JsonResource
{
    use AuthServiceApi;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'contract_id' => $this->contract_id,
            'code' => $this->code,
            'trip_date' => $this->trip_date,
            'description' => $this->description,
            'status' => $this->status,
            'status_details' => $this->getStatus(),
            'session' => $this->session,
            'type' => $this->type,
            'destination_photo' => formatImageUrl($this->destination_photo),
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'current_address' => $this->current_address,
            'current_lat' => $this->current_lat,
            'current_lng' => $this->current_lng,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'details' => $this->sortTripDetailsByTime($this->getCurrentParentId()),
            'vehicle_location' => $this->getVehicleLocation(),
            'school' => [
                'name' => $this->contract->school->name,
                'arrival_time_at_school' => $this->contract->time_arrive_school,
                'time_off' => $this->contract->time_off
            ],
            'driver' => new TripDriverResource($this->driver),
            'nany' => new TripNanyResource($this->nany)

        ];
    }

    protected function getVehicleLocation(): ?array
    {
        $scheduleOffRepository = app(ScheduleOffRepositoryInterface::class);
        $tripRepository = app(TripRepositoryInterface::class);
        $trip = $tripRepository->findOrFail($this->id);

        // Lấy danh sách học sinh nghỉ vào ngày chuyến đi
        $studentsOff = $scheduleOffRepository->getStudentsOffByDate($trip->trip_date);
        // Chuyển danh sách học sinh nghỉ thành mảng ID
        $studentsOffIds = $studentsOff->pluck('student_id')->toArray();

        // Lọc ra các chi tiết chuyến đi không bao gồm học sinh nghỉ
        $tripDetails = $trip->tripDetails->filter(function ($detail) use ($studentsOffIds) {
            return !in_array($detail->student_id, $studentsOffIds);
        });
        // Lọc lại danh sách học sinh nghỉ chỉ bao gồm những học sinh có trong chuyến đi
        $studentsOff = $studentsOff->filter(function ($offDetail) use ($trip) {
            return $trip->students->pluck('id')->contains($offDetail->student_id);
        });

        // Sắp xếp chi tiết chuyến đi theo thời gian đón học sinh
        $sortedTripDetails = $tripDetails->sortBy(function ($detail) {
            return $detail->pickupTime ?? Carbon::now()->addCentury();
        });

        // Tìm chi tiết chuyến đi tiếp theo chưa có thông tin check-in
        $nextActiveDetail = $sortedTripDetails->first(function ($detail) {
            return empty($detail->check_in);
        })->trip;

        // Lấy thông tin chi tiết đầu tiên của hợp đồng nếu có
        $contractDetails = $nextActiveDetail && $nextActiveDetail->contract && $nextActiveDetail->contract->detail->first() ? $nextActiveDetail->contract->detail->first() : null;

        // Tạo collection tài nguyên từ chi tiết chuyến đi đã sắp xếp
        $tripDetailsResource = TripDetailResource::collection($sortedTripDetails);

        // Trả về thông tin vị trí hiện tại của xe và thông tin điểm đón tiếp theo nếu có
        return [
            'current_lat' => $this->current_lat ?? null,
            'current_lng' => $this->current_lng ?? null,
            'current_address' => $this->current_address ?? null,
            'studentsOff' => $studentsOff,
            'next_destination' => $contractDetails ? [
                'pickup_address' => $contractDetails->pick_address,
                'longitude' => $contractDetails->longitude,
                'latitude' => $contractDetails->latitude,
            ] : null,
            'tripDetails' => $tripDetailsResource->resolve(),
        ];
    }


    /**
     * Filter and sort trip details by pickup time for related students only.
     *
     * @param int $parentId Parent's user ID to filter related students
     * @return AnonymousResourceCollection
     */
    protected function sortTripDetailsByTime(int $parentId): AnonymousResourceCollection
    {
        $filteredDetails = $this->tripDetails->filter(function ($detail) use ($parentId) {
            return $detail->student->parents->pluck('id')->contains($parentId);
        });

        $sortedDetails = $filteredDetails->sortBy(function ($detail) {
            return $detail->pickup_time ?? Carbon::now()->addCentury();
        });

        return TripDetailResource::collection($sortedDetails);
    }


    protected function getStatus()
    {
        if ($this->type === ContractType::PickUpOnly) {
            return [
                'not_picked_to_school' => PickupStatus::NotPickedToSchool,
                'picked_up_to_school' => PickupStatus::PickedUpToSchool,
                'arrived_at_school' => PickupStatus::ArrivedAtSchool,
            ];
        }

        if ($this->type === ContractType::DropOffOnly) {
            return [
                'not_picked_from_school' => PickupStatus::NotPickedFromSchool,
                'picked_up_from_school' => PickupStatus::PickedUpFromSchool,
                'arrived_at_home' => PickupStatus::ArrivedAtHome,
            ];
        }

        if ($this->type === ContractType::Both) {
            return [
                'not_picked_to_school' => PickupStatus::NotPickedToSchool,
                'picked_up_to_school' => PickupStatus::PickedUpToSchool,
                'arrived_at_school' => PickupStatus::ArrivedAtSchool,
                'not_picked_from_school' => PickupStatus::NotPickedFromSchool,
                'picked_up_from_school' => PickupStatus::PickedUpFromSchool,
                'arrived_at_home' => PickupStatus::ArrivedAtHome,
            ];
        }

        return $this->status;
    }
}
