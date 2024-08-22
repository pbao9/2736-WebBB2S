<?php


namespace App\Admin\Repositories\Province;

use App\Admin\Repositories\EloquentRepository;
use App\Models\Province;

class ProvinceRepository extends EloquentRepository implements ProvinceRepositoryInterface
{


    public function getModel()
    {
        return Province::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 30)
    {
        $query = $this->model->query();
        if (!empty($keySearch)) {
            $query->where('name', 'like', "%{$keySearch}%");
        }
        $this->applyFilters($meta);
        $results = $query->limit($limit)->get();

        return $results;
    }

    public function getActiveProvince()
    {
        return $this->model->query()->active()->get();
    }




}
