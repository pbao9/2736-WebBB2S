<?php

namespace App\Api\V1\Repositories\TripDetail;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface TripDetailRepositoryInterface extends EloquentRepositoryInterface
{
    public function getTripDetailByStudentId($student_id, $date);
}