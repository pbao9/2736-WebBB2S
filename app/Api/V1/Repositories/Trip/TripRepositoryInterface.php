<?php

namespace App\Api\V1\Repositories\Trip;

use App\Admin\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface TripRepositoryInterface extends EloquentRepositoryInterface
{
    public function getTripsByStudentsAndDate(array $studentIds, string $date);

}