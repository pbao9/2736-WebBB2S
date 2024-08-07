<?php

namespace App\Admin\Repositories\School;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface SchoolRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $limit = 10);
}
