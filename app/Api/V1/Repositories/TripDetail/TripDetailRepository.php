<?php

namespace App\Api\V1\Repositories\TripDetail;

use App\Admin\Repositories\TripDetail\TripDetailRepository as AdminRepository;


class TripDetailRepository extends AdminRepository implements TripDetailRepositoryInterface
{
    public function getTripDetailByStudentId($student_id, $date)
    {
        return $this->model->where('student_id', $student_id)
            ->whereHas('trip', function ($query) use ($date) {
                $query->where('trip_date', $date);
            })
            ->first();
    }
}
