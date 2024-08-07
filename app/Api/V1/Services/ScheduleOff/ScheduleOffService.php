<?php

namespace App\Api\V1\Services\ScheduleOff;

use App\Api\V1\Exception\BadRequestException;
use App\Api\V1\Http\Resources\ScheduleOff\ScheduleOffResource;
use App\Api\V1\Repositories\Driver\DriverRepositoryInterface;
use App\Api\V1\Repositories\Nany\NanyRepositoryInterface;
use App\Api\V1\Repositories\Notification\NotificationRepositoryInterface;
use App\Api\V1\Repositories\ScheduleOff\ScheduleOffRepositoryInterface;
use App\Api\V1\Support\AuthServiceApi;
use App\Api\V1\Support\Response;
use App\Enums\Contract\ContractStatus;
use App\Enums\DefaultStatus;
use App\Traits\NotifiesViaFirebase;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class ScheduleOffService implements ScheduleOffServiceInterface
{
    use UseLog, AuthServiceApi, Response, NotifiesViaFirebase;

    protected array $data;

    protected ScheduleOffRepositoryInterface $repository;

    protected DriverRepositoryInterface $driverRepository;

    protected NanyRepositoryInterface $nanyRepository;
    protected NotificationRepositoryInterface $notificationRepository;


    public function __construct(
        ScheduleOffRepositoryInterface  $repository,
        DriverRepositoryInterface       $driverRepository,
        NanyRepositoryInterface         $nanyRepository,
        NotificationRepositoryInterface $notificationRepository

    )
    {
        $this->repository = $repository;
        $this->driverRepository = $driverRepository;
        $this->nanyRepository = $nanyRepository;
        $this->notificationRepository = $notificationRepository;

    }

    /**
     * @throws Exception
     */
    public function createScheduleOff(Request $request): object|bool
    {
        $data = $request->validated();
        $driverId = $this->getCurrentDriverId();
        $nanyId = $this->getCurrentNanyId();
        $person = $driverId ? $this->driverRepository->findOrFail($driverId) : $this->nanyRepository->findOrFail($nanyId);
        $contracts = $person->contracts()->where('status', ContractStatus::Active)->get();

        $consolidatedSchedule = $this->getConsolidatedSchedule($contracts);
        $contractStartDate = $this->getEarliestContractStartDate($contracts);
        $contractEndDate = $this->getLatestContractEndDate($contracts);

        $dateOff = Carbon::parse($data['date_off']);
        $dayOfWeek = $dateOff->dayOfWeek;
        $adjustedDayOfWeek = $dayOfWeek + 1;

        if (!$dateOff->between($contractStartDate, $contractEndDate) || !in_array($adjustedDayOfWeek, $consolidatedSchedule)) {
            throw new BadRequestException("The requested off day is not a working day or outside the active contract period for this employee.");
        }

        $exists = $this->repository->exists([
            ['date_off', '=', $data['date_off']],
            ['driver_id', '=', $driverId],
            ['nany_id', '=', $nanyId],
        ]);

        if ($exists) {
            throw new BadRequestException("A day off for this date has already been requested.");
        }

        $scheduleOffData = [
            'date_off' => $data['date_off'],
            'note' => $data['note'],
            'driver_id' => $driverId,
            'nany_id' => $nanyId,
            'status' => DefaultStatus::Active
        ];

        DB::beginTransaction();
        try {
            $title = config('notifications.leave_request_notification.title');
            $bodyTemplate = config('notifications.leave_request_notification.message');
            $body = str_replace(
                ['{employee_name}', '{phone_number}', '{date_off}'],
                [$person->user->fullname, $person->user->phone, $dateOff->format('d/m/Y')],
                $bodyTemplate
            );

            $this->sendNotificationsToAdmins($title, $body);

            $scheduleOff = $this->repository->create($scheduleOffData);
            DB::commit();
            return $scheduleOff;
        } catch (Exception $e) {
            DB::rollback();
            $this->logError('Failed to create schedule off', $e);
            return false;
        }
    }


    /**
     * @throws Exception
     */
    public function getSchedule(): JsonResponse
    {
        $person = $this->getCurrentDriver() ?: $this->getCurrentNany();

        $contracts = $person->contracts()->where('status', ContractStatus::Active)->get();
        $schedule = $this->getConsolidatedSchedule($contracts);
        $contractStartDate = $this->getEarliestContractStartDate($contracts);
        $contractEndDate = $this->getLatestContractEndDate($contracts);
        $daysOff = $person->scheduleOff()->get()->map(function ($scheduleOff) {
            return new ScheduleOffResource($scheduleOff);
        });

        $response = [
            'schedule' => $schedule,
            'days_off' => $daysOff,
            'contract_start_date' => $contractStartDate ?? null,
            'contract_end_date' => $contractEndDate ?? null

        ];
        return $this->jsonResponseSuccess($response);
    }

    private function getConsolidatedSchedule($contracts): array
    {
        $allDays = [];
        foreach ($contracts as $contract) {
            $days = json_decode($contract->schedule, true);
            if (is_array($days)) {
                $allDays = array_merge($allDays, $days);
            }
        }

        $uniqueDays = array_unique($allDays);
        sort($uniqueDays);

        return $uniqueDays;
    }

    private function getEarliestContractStartDate($contracts): ?Carbon
    {
        $minDate = $contracts->min('created_at');
        return $minDate ? Carbon::parse($minDate) : null;
    }

    private function getLatestContractEndDate($contracts): ?Carbon
    {
        $maxDate = $contracts->max('expired_at');
        return $maxDate ? Carbon::parse($maxDate) : null;
    }

    /**
     * @throws Exception
     */
    public function delete($id): object
    {
        return $this->repository->update($id, ['status' => DefaultStatus::Deleted]);
    }

    /**
     * @throws Exception
     */
    public function restore($id): object
    {
        return $this->repository->update($id, ['status' => DefaultStatus::Active]);
    }
}
