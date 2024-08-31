<?php

namespace App\Api\V1\Services\Student;

use App\Admin\Services\File\FileService;
use App\Api\V1\Http\Resources\ScheduleOff\ScheduleOffResource;
use App\Api\V1\Repositories\ScheduleOff\ScheduleOffRepositoryInterface;
use App\Api\V1\Repositories\TripDetail\TripDetailRepositoryInterface;
use  App\Api\V1\Repositories\Student\StudentRepositoryInterface;
use App\Api\V1\Support\Response;
use App\Enums\DefaultStatus;
use App\Enums\ScheduleOff\ScheduleOffType;
use App\Enums\Trip\PickupStatus;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use Illuminate\Support\Facades\DB;

class StudentService implements StudentServiceInterface
{
    use Setup, Response, UseLog;

    /**
     * Current Object instance
     *
     * @var array
     */
    protected array $data;

    protected StudentRepositoryInterface $repository;

    protected ScheduleOffRepositoryInterface $scheduleOffRepository;

    protected TripDetailRepositoryInterface $tripDetailRepository;

    protected FileService $fileService;


    public function __construct(StudentRepositoryInterface     $repository,
                                TripDetailRepositoryInterface  $tripDetailRepository,
                                FileService                    $fileService,
                                ScheduleOffRepositoryInterface $scheduleOffRepository)
    {
        $this->repository = $repository;
        $this->scheduleOffRepository = $scheduleOffRepository;
        $this->tripDetailRepository = $tripDetailRepository;
        $this->fileService = $fileService;
    }


    public function update(Request $request): object|bool
    {
        $data = $request->validated();
        $student = $this->repository->findOrFail($data['id']);
        if (isset($data['avatar'])) {
            $avatar = $data['avatar'];
            $data['avatar'] = $this->fileService->uploadAvatar('images/student', $avatar, $student->avatar);
        }
        return $this->repository->update($data['id'], $data);
    }

    /**
     * @throws Exception
     */
    public function delete(Request $request): object|bool
    {
        $data = $request->validated();

        return $this->repository->deleteScheduleOff($data['id'], $data['student_id']);
    }

    public function getScheduleForStudent($studentId): array
    {
        $student = $this->repository->findOrFail($studentId);
        $contract = $student->contract;
        $daysOff = $student->scheduleOff()->get()->map(function ($scheduleOff) {
            return new ScheduleOffResource($scheduleOff);
        });

        $publicDaysOff = $this->scheduleOffRepository->getBy(
            [
                'type' => ScheduleOffType::Public->value,
                'status' => DefaultStatus::Active
            ]
        ) ?? [];

        if (!$contract) {
            return [
                'schedule' => [],
                'days_off' => $daysOff,
                'public_days_off' => $publicDaysOff,
                'contract_start_date' => null,
                'contract_end_date' => null
            ];
        }

        $schedule = $contract->schedule ?? [];

        return [
            'schedule' => json_decode($schedule, true),
            'days_off' => $daysOff,
            'public_days_off' => $publicDaysOff,
            'contract_start_date' => $contract->created_at,
            'contract_end_date' => $contract->expired_at
        ];
    }


    public function createScheduleOff(Request $request): object|bool
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $studentId = $data['student_id'];
            $dateOff = $data['date_off'];
            $data['status'] = DefaultStatus::Active;
            $tripDetails = $this->tripDetailRepository->getTripsByStudentAndDate($studentId, $dateOff);
            foreach ($tripDetails as $tripDetail) {
                $this->tripDetailRepository->updateAttribute($tripDetail->id,
                    'picked_up', PickupStatus::ExcusedAbsence);
            }

            $response = $this->scheduleOffRepository->create($data);
            DB::commit();
            return $response;
        } catch (Exception $e) {
            DB::rollback();
            $this->logError("Error for api store schedule off", $e);
            return false;
        }
    }
}
