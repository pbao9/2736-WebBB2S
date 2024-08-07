<?php

namespace App\Traits;


use App\Enums\Contract\ContractType;
use App\Enums\Session\Session;
use App\Enums\Trip\PickupStatus;
use App\Enums\Trip\TripStatus;
use Exception;
use Illuminate\Support\Carbon;

trait SchedulesTrips
{
    /**
     * Lập lịch chuyến đi cho hợp đồng trong một tháng cụ thể.
     *
     * Phương thức này duyệt qua từng ngày trong tháng hiện tại
     * và kiểm tra xem ngày đó có nằm trong lịch trình của hợp đồng hay không.
     * Nếu có, nó sẽ gọi phương thức `processContractType` để lập lịch cho chuyến đi vào ngày đó.
     *
     * @param object $contract Đối tượng hợp đồng cần lập lịch.
     * @throws Exception Ngoại lệ có thể được ném ra nếu có lỗi trong quá trình lập lịch chuyến đi.
     */
    protected function scheduleTripsForContract(object $contract): void
    {
        $schedule = is_array($contract->schedule) ? $contract->schedule : json_decode($contract->schedule, true);

        $startDate = Carbon::parse($contract->created_at);
        $endDate = Carbon::parse($contract->expired_at);
        $currentDate = Carbon::now();
        if ($startDate->lt($currentDate)) {
            $startDate = $currentDate->copy();
        }

        while ($startDate->lte($endDate)) {
            $dayOfWeek = $startDate->dayOfWeek;
            $adjustedDayOfWeek = ($dayOfWeek % 7) + 1;

            if (in_array((string)$adjustedDayOfWeek, $schedule)) {
                $tripDate = $startDate->copy();
                $this->processContractType($contract, $tripDate);
            }

            $startDate->addDay();
        }
    }

    /**
     * Lập lịch chuyến đi cho hợp đồng "Active" trong khoảng thời gian từ ngày hết hạn cũ đến ngày hết hạn mới.
     *
     * @param object $contract Đối tượng hợp đồng cần lập lịch.
     * @param Carbon $startFromDate Ngày bắt đầu lập lịch (ngày hết hạn cũ).
     * @param Carbon $endAtDate Ngày kết thúc lập lịch (ngày hết hạn mới).
     * @throws Exception Ngoại lệ có thể được ném ra nếu có lỗi trong quá trình lập lịch chuyến đi.
     */
    protected function scheduleActiveContractTrips(object $contract, Carbon $startFromDate, Carbon $endAtDate): void
    {
        $schedule = is_array($contract->schedule) ? $contract->schedule : json_decode($contract->schedule, true);

        $currentDate = Carbon::now();
        $startDate = $startFromDate->gt($currentDate) ? $startFromDate : $currentDate;

        while ($startDate->lte($endAtDate)) {
            $dayOfWeek = $startDate->dayOfWeek;
            $adjustedDayOfWeek = ($dayOfWeek % 7) + 1;

            if (in_array((string)$adjustedDayOfWeek, $schedule)) {
                $tripDate = $startDate->copy();
                $this->processContractType($contract, $tripDate);
            }

            $startDate->addDay();
        }
    }


    /**
     * Xử lý các loại hợp đồng và tạo lịch trình chuyến đi
     *
     * Phương thức này duyệt qua các chi tiết của hợp đồng và tạo lịch trình chuyến đi dựa trên thời gian đón hoặc thời gian trả.
     * Đối với mỗi chi tiết hợp đồng có thời gian đón hoặc trả, phương thức sẽ xác định buổi (sáng hoặc chiều) và lập lịch cho chuyến đi tương ứng.
     *
     * @param object $contract Đối tượng hợp đồng cần xử lý.
     * @param Carbon $tripDate Ngày thực hiện chuyến đi.
     * @throws Exception Ngoại lệ có thể được ném ra nếu có lỗi trong quá trình lập lịch chuyến đi.
     */
    protected function processContractType(object $contract, Carbon $tripDate): void
    {
        foreach ($contract->detail as $detail) {
            switch ($contract->type) {
                case ContractType::Both->value:
                    if ($detail->time_pick) {
                        $session = $this->determineSession($detail->time_pick);
                        if (!$this->tripRepository->tripExists($contract->id, $tripDate->format('Y-m-d'),
                            ContractType::PickUpOnly, $session)) {
                            $this->scheduleTrip($contract, $tripDate, $session, ContractType::PickUpOnly);
                        }
                    }
                    if ($detail->time_arrive_home) {
                        $session = $this->determineSession($detail->time_arrive_home);
                        if (!$this->tripRepository->tripExists($contract->id, $tripDate->format('Y-m-d'),
                            ContractType::DropOffOnly, $session)) {
                            $this->scheduleTrip($contract, $tripDate, $session, ContractType::DropOffOnly);
                        }
                    }
                    break;
                case ContractType::PickUpOnly->value:
                    if ($detail->time_pick) {
                        $session = $this->determineSession($detail->time_pick);
                        if (!$this->tripRepository->tripExists($contract->id, $tripDate->format('Y-m-d'),
                            ContractType::PickUpOnly, $session)) {
                            $this->scheduleTrip($contract, $tripDate, $session, ContractType::PickUpOnly);
                        }
                    }
                    break;
                case ContractType::DropOffOnly->value:
                    if ($detail->time_arrive_home) {
                        $session = $this->determineSession($detail->time_arrive_home);
                        if (!$this->tripRepository->tripExists($contract->id, $tripDate->format('Y-m-d'),
                            ContractType::DropOffOnly, $session)) {
                            $this->scheduleTrip($contract, $tripDate, $session, ContractType::DropOffOnly);
                        }
                    }
                    break;
            }
        }
    }


    /**
     * Xác định buổi dựa trên thời gian
     *
     * @param string $time Thời gian dạng H:i:s
     * @return int Buổi sáng hoặc buổi chiều
     */
    protected function determineSession(string $time): int
    {
        $timeCarbon = Carbon::createFromFormat('H:i:s', $time);
        return $timeCarbon->hour < 12 ? Session::Morning : Session::Afternoon;
    }

    /**
     * Tạo và lập lịch cho một chuyến đi mới
     *
     * Phương thức này tạo một chuyến đi mới dựa trên thông tin hợp đồng, ngày thực hiện chuyến đi, buổi và loại chuyến đi.
     * Sau khi tạo chuyến đi, phương thức này cũng tạo các chi tiết chuyến đi cho từng học sinh trong hợp đồng.
     *
     * @param object $contract Đối tượng hợp đồng liên quan đến chuyến đi.
     * @param Carbon $tripDate Ngày thực hiện chuyến đi.
     * @param int $session Buổi của chuyến đi (Session::Morning hoặc Session::Afternoon).
     * @param ContractType $type Loại chuyến đi (2: Buổi đi, 3: Buổi về).
     * @throws Exception Ngoại lệ có thể được ném ra nếu có lỗi trong quá trình tạo chuyến đi.
     */
    protected function scheduleTrip(object $contract, Carbon $tripDate, int $session, ContractType $type): void
    {
        $trip = $this->createTripForContract($contract, $tripDate, $session, $type);

        $this->createTripDetailsForStudents($trip, $contract->students);
    }

    /**
     * Tạo một chuyến đi mới dựa trên thông tin hợp đồng và ngày chuyến đi cụ thể.
     *
     * Phương thức này tạo ra một bản ghi mới cho chuyến đi trong cơ sở dữ liệu. Mỗi chuyến đi được xác định bởi
     * một mã duy nhất (sử dụng uniqid), và được thiết lập trạng thái là đang chờ (Pending).
     * Các thông tin về chuyến đi như ID hợp đồng, mã chuyến đi, ngày chuyến đi và trạng thái
     * sẽ được lưu vào cơ sở dữ liệu.
     *
     * @param object $contract Đối tượng hợp đồng liên quan đến chuyến đi.
     * @param Carbon $tripDate Ngày thực hiện chuyến đi.
     * @return object Trả về đối tượng chuyến đi mới được tạo.
     * @throws Exception Ngoại lệ có thể được ném ra nếu có lỗi trong quá trình tạo chuyến đi.
     */
    public function createTripForContract(object $contract, Carbon $tripDate, $session, $type): object
    {
        $code = uniqid();
        return $this->tripRepository->create([
            'contract_id' => $contract->id,
            'session' => $session,
            'code' => $code,
            'trip_date' => $tripDate,
            'type' => $type,
            'driver_id' => $contract->driver_id,
            'nany_id' => $contract->nany_id,
            'status' => TripStatus::Pending,
        ]);
    }

    /**
     * Tạo chi tiết chuyến đi cho mỗi học sinh liên quan đến chuyến đi đã cho.
     *
     * Phương thức này lặp qua danh sách các học sinh và tạo một bản ghi chi tiết chuyến đi
     * cho mỗi học sinh. Chi tiết chuyến đi này bao gồm việc đánh dấu học sinh như chưa được đón.
     * Nếu quá trình tạo gặp lỗi, một ngoại lệ sẽ được ném ra.
     *
     * @param object $trip Đối tượng chuyến đi mà chi tiết sẽ được tạo.
     * @param iterable $students Danh sách các học sinh cần tạo chi tiết chuyến đi.
     * @throws Exception Ngoại lệ sẽ được ném ra nếu có lỗi trong quá trình tạo chi tiết chuyến đi.
     */
    protected function createTripDetailsForStudents(object $trip, iterable $students): void
    {
        foreach ($students as $student) {
            $pickedUpStatus = match ($trip->type) {
                ContractType::DropOffOnly => PickupStatus::NotPickedFromSchool,
                default => PickupStatus::NotPickedToSchool,
            };
            $this->tripDetailRepository->create([
                'trip_id' => $trip->id,
                'student_id' => $student->id,
                'picked_up' => $pickedUpStatus
            ]);
        }
    }
}
