<?php

namespace App\Api\V1\Services\Trip;

use App\Admin\Repositories\TripDetail\TripDetailRepositoryInterface;
use App\Admin\Services\File\FileService;
use App\Api\V1\Repositories\Nany\NanyRepositoryInterface;
use App\Api\V1\Repositories\Student\StudentRepositoryInterface;
use App\Api\V1\Repositories\Trip\TripRepositoryInterface;
use App\Api\V1\Support\AuthServiceApi;
use App\Enums\Contract\ContractStatus;
use App\Enums\Trip\PickupStatus;
use App\Enums\Trip\TripStatus;
use App\Traits\NotifiesViaFirebase;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TripService implements TripServiceInterface
{
    use UseLog, AuthServiceApi, NotifiesViaFirebase;

    protected array $data;

    private string $folderTrip = "images/trips";

    protected TripRepositoryInterface $repository;

    protected StudentRepositoryInterface $studentRepository;

    protected TripDetailRepositoryInterface $tripDetailRepository;

    protected NanyRepositoryInterface $nanyRepository;

    protected FileService $fileService;

    public function __construct(
        TripRepositoryInterface       $repository,
        StudentRepositoryInterface    $studentRepository,
        TripDetailRepositoryInterface $tripDetailRepository,
        NanyRepositoryInterface       $nanyRepository,
        FileService                   $fileService
    )
    {
        $this->repository = $repository;
        $this->studentRepository = $studentRepository;
        $this->fileService = $fileService;
        $this->tripDetailRepository = $tripDetailRepository;
        $this->nanyRepository = $nanyRepository;
    }


    /**
     * @throws Exception
     */
    public function getTripsByStaff(Request $request)
    {
        $data = $request->validated();
        $driverId = $this->getCurrentDriverId();
        $nanyId = $this->getCurrentNanyId();
        $type = $data['type'] ?? null;
        $status = $data['status'] ?? null;
        $limit = $data['limit'] ?? 10;
        $page = $data['page'] ?? 1;
        $date = $data['date'] ?? null;
        $session = $data['session'] ?? null;

        $staffColumn = $nanyId ? 'nany_id' : 'driver_id';
        $staffId = $nanyId ?: $driverId;

        $filters = [['trips.' . $staffColumn, '=', $staffId]];

        if ($type !== null) {
            $filters[] = ['trips.type', '=', $type];
        }
        if ($status !== null) {
            $filters[] = ['trips.status', '=', $status];
        }
        if ($date) {
            $filters[] = ['trips.trip_date', '=', $date];
        }
        if ($session) {
            $filters[] = ['trips.session', '=', $session];
        }

        $query = $this->repository->getQueryBuilder()
            ->with(['driver.user', 'nany'])
            ->join('contracts as c', 'trips.contract_id', '=', 'c.id')
            ->where('c.status', '=', ContractStatus::Active)
            ->whereRaw('DATE(c.created_at) <= DATE(trips.trip_date)')
            ->whereRaw('DATE(c.expired_at) >= DATE(trips.trip_date)')
            ->where($filters)
            ->select('trips.*')
            ->orderBy('trip_date', 'asc');

        return $query->paginate($limit, ['*'], 'page', $page);
    }


    public function updateStudentArrivalSchool(Request $request): bool|object
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $trip = $this->repository->findOrFail($data['id']);
            $tripDetails = $trip->tripDetails;
            foreach ($tripDetails as $tripDetail) {
                $this->tripDetailRepository->update($tripDetail->id, [
                    'picked_up' => PickupStatus::ArrivedAtSchool
                ]);
                $parents = $tripDetail->student->parents;
                foreach ($parents as $parent) {
                    if ($parent->user->device_token) {
                        $title = config('notifications.student_arrived_at_school.title');
                        $message = config('notifications.student_arrived_at_school.message');
                        $this->sendFirebaseNotificationToParent($parent, $title, $message);
                    }
                }
            }
            $data = $this->fileService->uploadImages(
                $this->folderTrip,
                $data,
                ['destination_photo'],
                $trip
            );
            $data['check_out'] = Carbon::now();
            $trip = $this->repository->update($trip->id, $data);


            DB::commit();
            return $trip;
        } catch (Exception $e) {
            DB::rollback();
            $this->logError('Failed to process complete Arrived At School', $e);
            return false;
        }
    }

    /**
     * @throws Exception
     */
    public function getTripDetails(int $id)
    {
        return $this->repository->findOrFail($id);
    }


    /**
     * @throws Exception
     */
    public function startTrip(Request $request): object|bool
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $trip = $this->repository->findOrFail($data['id']);
            $data['status'] = TripStatus::Active;
            $data['check_in'] = Carbon::now();
            DB::commit();
            return $this->repository->update($trip->id, $data);
        } catch (Exception $e) {
            DB::rollback();
            $this->logError('Failed to process start for trip', $e);
            return false;
        }
    }


    /**
     * @throws Exception
     */
    public function endTrip(Request $request): object
    {
        $data = $request->validated();
        $trip = $this->repository->findOrFail($data['id']);
        $data['status'] = TripStatus::Completed;
        $data['check_in'] = Carbon::now();
        return $this->repository->update($trip->id, $data);
    }

    /**
     * @throws Exception
     */
    public function updateLocation(Request $request): object
    {
        $data = $request->validated();
        return $this->repository->update($data['id'], $data);
    }

    /**
     * @throws Exception
     */
    public function startTripFromSchool(Request $request): object
    {
        $data = $request->validated();
        $trip = $this->repository->findOrFail($data['id']);
        $data['status'] = TripStatus::Active;
        $tripDetails = $trip->tripDetails;
        foreach ($tripDetails as $tripDetail) {
            $this->tripDetailRepository->update($tripDetail->id, [
                'picked_up' => PickupStatus::PickedUpFromSchool,
                'check_in' => Carbon::now()
            ]);

        }
        $data = $this->fileService->uploadImages(
            $this->folderTrip,
            $data,
            ['destination_photo'],
            $trip
        );
        $data['check_in'] = Carbon::now();
        return $this->repository->update($data['id'], $data);
    }
}
