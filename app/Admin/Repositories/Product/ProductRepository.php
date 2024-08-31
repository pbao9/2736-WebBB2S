<?php

namespace App\Admin\Repositories\Product;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Models\Post;
use App\Models\Product;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Product::class;
    }


    public function paginate(array $filter, array $relationCondition = [], array $relations = [], int $paginate = 12)
    {

        $this->getQueryBuilder();

        $this->applyFilters($filter);

        foreach ($relationCondition as $relation => $condition) {
            $this->instance = $this->instance->whereHas($relation, $condition);
        }

        return $this->instance->published()->with($relations)->paginate($paginate);
    }

    public function findOrFailWithRelations($id, array $relations = [])
    {
        $this->findOrFail($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function getByLimit(array $filter, array $filterRelation = [], array $relations = [], int $limit = 3, array $sort = ['id', 'desc'])
    {

        $this->getQueryBuilder();

        $this->applyFilters($filter);

        foreach ($filterRelation as $relation => $condition) {
            $this->instance = $this->instance->whereHas($relation, $condition);
        }

        return $this->instance->published()->with($relations)->limit($limit)->orderBy(...$sort)->get();
    }
}
