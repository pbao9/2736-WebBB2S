<?php

namespace App\Api\V1\Repositories\Trip;


use App\Admin\Repositories\Trip\TripRepository as AdminRepository;


class TripRepository extends AdminRepository implements TripRepositoryInterface
{


    public function getTripsByStudentsAndDate(array $studentIds, string $date)
    {
        return $this->model
            ->whereHas('tripDetails', function ($query) use ($studentIds) {
                $query->whereIn('student_id', $studentIds);
            })
            ->whereDate('trip_date', $date)
            ->with(['tripDetails.student', 'driver', 'nany', 'contract.school'])
            ->get();
    }


}