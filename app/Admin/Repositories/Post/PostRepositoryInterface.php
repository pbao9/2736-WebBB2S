<?php

namespace App\Admin\Repositories\Post;

use App\Admin\Repositories\EloquentRepositoryInterface;
use App\Models\Post;

interface PostRepositoryInterface extends EloquentRepositoryInterface
{
    public function findOrFailWithRelations($id, array $relations = ['categories']);
    public function attachCategories(Post $post, array $categoriesId);
    public function syncCategories(Post $post, array $categoriesId);
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function paginate(array $filter, array $relationCondition = [], array $relations = [], int $paginate = 10);
    public function getByLimit(array $filter, array $filterRelation = [], array $relations = [], int $limit = 10, array $sort = ['id', 'desc']);
}
