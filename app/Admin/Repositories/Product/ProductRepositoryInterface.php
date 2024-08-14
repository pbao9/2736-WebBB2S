<?php

namespace App\Admin\Repositories\Product;

use App\Admin\Repositories\EloquentRepositoryInterface;
use App\Models\Post;

interface ProductRepositoryInterface extends EloquentRepositoryInterface
{
    public function findOrFailWithRelations($id, array $relations = []);
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function paginate(array $filter, array $relationCondition = [], array $relations = [], int $paginate = 10);
    public function getByLimit(array $filter, array $filterRelation = [], array $relations = [], int $limit = 10, array $sort = ['id', 'desc']);
}
