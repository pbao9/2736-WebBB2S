<?php


namespace App\Admin\Repositories\Ward;

use App\Models\Ward;
use App\Admin\Repositories\EloquentRepository;

class WardRepository extends EloquentRepository implements WardRepositoryInterface
{


    public function getModel()
    {
        return Ward::class;
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
}
