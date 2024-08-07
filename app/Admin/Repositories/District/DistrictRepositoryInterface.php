<?php

namespace App\Admin\Repositories\District;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface DistrictRepositoryInterface extends EloquentRepositoryInterface
{

    public function searchAllLimit($provinceCode, $keySearch = '', $meta = [], $limit = 30);

}
