<?php

namespace App\Api\V1\Services\Parent;

use App\Api\V1\Repositories\Parent\ParentRepositoryInterface;
use App\Api\V1\Repositories\Student\StudentRepositoryInterface;
use App\Api\V1\Repositories\Trip\TripRepositoryInterface;
use App\Api\V1\Repositories\TripDetail\TripDetailRepositoryInterface;
use App\Api\V1\Support\AuthServiceApi;
use App\Api\V1\Support\Response;

use App\Traits\UseLog;

use App\Admin\Traits\Setup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ParentService implements ParentServiceInterface
{
    use Setup, Response, UseLog, AuthServiceApi;

    /**
     * Current Object instance
     *
     * @var array
     */
    protected array $data;

    protected ParentRepositoryInterface $repository;

    protected TripRepositoryInterface $tripRepository;

    protected StudentRepositoryInterface $studentRepository;

    protected TripDetailRepositoryInterface $tripDetailRepository;


    public function __construct(ParentRepositoryInterface     $repository,
                                StudentRepositoryInterface    $studentRepository,
                                TripDetailRepositoryInterface $tripDetailRepository,
                                TripRepositoryInterface       $tripRepository)

    {
        $this->repository = $repository;
        $this->tripRepository = $tripRepository;
        $this->studentRepository = $studentRepository;
        $this->tripDetailRepository = $tripDetailRepository;
    }


    /**
     * @throws \Exception
     */
    public function getTripsByParent(Request $request): Collection
    {
        $data = $request->validated();
        $parent = $this->getCurrentParent();
        $studentIds = $parent->students()->pluck('id')->toArray();
        return $this->tripRepository->getTripsByStudentsAndDate($studentIds, $data['date']);
    }

    /**
     * @throws \Exception
     */
    public function tripDetail(Request $request)
    {
        $data = $request->validated();
        $tripDetail = $this->tripDetailRepository->findOrFail($data['id']);
        $trip = $tripDetail->trip;

        $tripDate = Carbon::parse($trip->trip_date);

        if ($tripDate->format('Y-m-d') === $data['trip_date']) {
            return $trip;
        }
        return null;
    }
}
