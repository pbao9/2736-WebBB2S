<?php

namespace App\Api\V1\Services\TripDetail;

use App\Admin\Services\File\FileService;
use App\Api\V1\Repositories\Driver\DriverRepositoryInterface;
use App\Api\V1\Repositories\Nany\NanyRepositoryInterface;
use App\Api\V1\Repositories\Notification\NotificationRepositoryInterface;
use App\Api\V1\Repositories\Trip\TripRepositoryInterface;
use App\Api\V1\Repositories\TripDetail\TripDetailRepositoryInterface;
use App\Api\V1\Support\AuthServiceApi;
use App\Enums\Contract\ContractType;
use App\Enums\Trip\PickupStatus;
use App\Traits\NotifiesViaFirebase;
use App\Traits\UseLog;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;


class TripDetailService implements TripDetailServiceInterface
{
    use UseLog, AuthServiceApi, NotifiesViaFirebase;

    protected array $data;

    private string $folderTrip = "images/trips";

    protected TripDetailRepositoryInterface $repository;

    protected NanyRepositoryInterface $nanyRepository;

    protected DriverRepositoryInterface $driverRepository;

    protected NotificationRepositoryInterface $notificationRepository;

    protected TripRepositoryInterface $tripRepository;

    protected FileService $fileService;


    public function __construct(
        TripDetailRepositoryInterface   $repository,
        FileService                     $fileService,
        NanyRepositoryInterface         $nanyRepository,
        DriverRepositoryInterface       $driverRepository,
        TripRepositoryInterface         $tripRepository,
        NotificationRepositoryInterface $notificationRepository,
    )
    {
        $this->repository = $repository;
        $this->fileService = $fileService;
        $this->nanyRepository = $nanyRepository;
        $this->driverRepository = $driverRepository;
        $this->tripRepository = $tripRepository;
        $this->notificationRepository = $notificationRepository;
    }


    /**
     * @throws Throwable
     */
    public function checkPickupStatus(Request $request): bool|object
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $nanyId = $this->getCurrentNanyId();
            if (!$nanyId) {
                $this->logNotFound("Nany not found", $nanyId);
                return false;
            }
            $data['check_in'] = Carbon::now();
            $tripDetail = $this->repository->findOrFail($data['id']);
            $trip = $tripDetail->trip;
            $data['picked_up'] = PickupStatus::PickedUpFromSchool;
            if ($trip->type == ContractType::PickUpOnly) {
                $data['picked_up'] = PickupStatus::PickedUpToSchool;
            }
            $data = $this->fileService->uploadImages($this->folderTrip, $data,
                ['student_image'], $tripDetail);
            $tripDetail = $this->repository->update($data['id'], $data);
            $this->tripRepository->update($trip->id, $data);
            DB::commit();
            return $tripDetail;
        } catch (Throwable $e) {
            DB::rollback();
            $this->logError('Failed to process check pickup status for trip detail', $e);
            return false;
        }

    }

    /**
     * @throws Exception
     */
    public function notifyParentOfArrival(Request $request): bool
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $tripDetail = $this->repository->findOrFail($data['id']);
            $trip = $tripDetail->trip;
            $type = $trip->type;
            $student = $tripDetail->student;
            $parents = $student->parents;

            foreach ($parents as $parent) {
                if ($type == ContractType::PickUpOnly) {
                    $title = config('notifications.bus_arrival_soon.title');
                    $body = config('notifications.bus_arrival_soon.message');
                } else {
                    $title = config('notifications.bus_arriving_soon_pickup.title');
                    $body = config('notifications.bus_arriving_soon_pickup.message');
                }
                $this->sendFirebaseNotificationToParent($parent, $title, $body);
            }

            $this->tripRepository->update($trip->id, $data);

            DB::commit();
            return true;
        } catch (Throwable $e) {
            DB::rollback();
            $this->logError('Failed to notify parent of arrival', $e);
            return false;
        }
    }

    public function endTrip(Request $request): bool|object
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $tripDetail = $this->repository->findOrFail($data['id']);
            $trip = $tripDetail->trip;
            $student = $tripDetail->student;
            $parents = $student->parents;

            $title = config('notifications.trip_ended.title');
            $body = config('notifications.trip_ended.message');
            foreach ($parents as $parent) {
                $this->sendFirebaseNotificationToParent($parent, $title, $body);
            }

            $data['picked_up'] = PickupStatus::ArrivedAtHome;
            $data['check_out'] = Carbon::now();
            $tripDetail = $this->repository->update($tripDetail->id, $data);
            $this->tripRepository->update($trip->id, $data);

            DB::commit();
            return $tripDetail;
        } catch (Throwable $e) {
            DB::rollback();
            $this->logError('Failed to end the trip', $e);
            return false;
        }
    }

    public function getTripsByStudentId(Request $request)
    {
        $data = $request->validated();

        return $this->repository->getTripDetailByStudentId($data['student_id'], $data['date']);
    }

    /**
     * @throws Exception
     */
    public function skipStudent(Request $request): object
    {
        $data = $request->validated();
        $data['picked_up'] = PickupStatus::Skipped;
        return $this->repository->update($data['id'], $data);
    }

    /**
     * @throws Exception
     */
    public function updateStudentArrivalHome(Request $request): object|bool
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $trip = $this->tripRepository->findOrFail($data['id']);
            $tripDetails = $trip->tripDetails;
            foreach ($tripDetails as $tripDetail) {
                $this->repository->update($tripDetail->id, [
                    'picked_up' => PickupStatus::ArrivedAtSchool
                ]);
            }
            $data = $this->fileService->uploadImages(
                $this->folderTrip,
                $data,
                ['destination_photo'],
                $trip
            );
            $data['check_out'] = Carbon::now();
            $trip = $this->tripRepository->update($trip->id, $data);
            DB::commit();
            return $trip;
        } catch (Exception $e) {
            DB::rollback();
            $this->logError('Failed to process complete Arrived At School', $e);
            return false;
        }
    }
}
