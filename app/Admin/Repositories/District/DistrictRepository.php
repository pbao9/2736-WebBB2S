<?php

namespace App\Admin\Repositories\District;

use App\Admin\Http\Resources\Province\ProvinceSearchSelectResource;
use App\Admin\Repositories\District\DistrictRepositoryInterface;
use App\Admin\Repositories\EloquentRepository;
use App\Models\District;
use Illuminate\Support\Facades\Request;

class DistrictRepository extends EloquentRepository implements DistrictRepositoryInterface
{


    public function getModel()
    {
        return District::class;
    }

    public function getQueryBuilderOrderBy($column = 'name', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function searchAllLimit($provinceCode, $keySearch = '', $meta = [], $limit = 30)
    {

        $query = $this->model->query();

        if (!empty($provinceCode)) {
            $query->where('province_code', $provinceCode);
        }
        if (!empty($keySearch)) {
            $query->where('name', 'like', "%{$keySearch}%");
        }
        $this->applyFilters($meta);
        $results = $query->limit($limit)->get();

        return $results;
    }
}
