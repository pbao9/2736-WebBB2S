<?php

namespace App\Admin\Repositories\School;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\School\SchoolRepositoryInterface;
use App\Enums\School\SchoolStatus;
use App\Models\School;
use Illuminate\Database\Eloquent\Collection;

class SchoolRepository extends EloquentRepository implements SchoolRepositoryInterface
{
    public function getModel(): string
    {
        return School::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10, $districtCode = null): Collection|array
    {
        $query = $this->model->newQuery();
    
        // Apply search conditions
        $this->applySearchConditions($query, $keySearch);

        $query->where('status', SchoolStatus::Active);
    
        // Apply district code filter if provided
        if ($districtCode) {
            $query->where('district_code', $districtCode);
        }
    
        // Apply any additional filters
        $this->applyFilters($meta);
    
        // Fetch the results with the specified limit
        return $query->limit($limit)->get();
    }
    
    protected function applySearchConditions($query, $keySearch): void
    {
        if ($keySearch !== '') {
            $query->where(function ($subQuery) use ($keySearch) {
                $subQuery->where('name', 'LIKE', "%$keySearch%")
                         ->orWhere('address', 'LIKE', "%$keySearch%");
            });
        }
    }
    
}
