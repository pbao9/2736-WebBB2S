<?php

namespace App\Api\V1\Http\Resources\Trip;

use App\Api\V1\Http\Resources\TripDetail\TripDetailResource;
use App\Enums\Contract\ContractType;
use App\Enums\Trip\PickupStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
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
            'details' => $this->sortTripDetailsByTime(),
            'school' => [
                'name' => $this->contract->school->name,
                'arrival_time_at_school' => $this->contract->time_arrive_school,
                'time_off' => $this->contract->time_off
            ],
            'driver' => new TripDriverResource($this->driver),
            'nany' => new TripNanyResource($this->nany)

        ];
    }

    /**
     * Sort trip details by pickup time.
     *
     * @return AnonymousResourceCollection
     */
    protected function sortTripDetailsByTime(): AnonymousResourceCollection
    {
        $sortedDetails = $this->tripDetails->sortBy(function ($detail) {
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
