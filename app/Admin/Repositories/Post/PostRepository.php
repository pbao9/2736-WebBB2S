<?php

namespace App\Admin\Repositories\Post;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Post\PostRepositoryInterface;
use App\Models\Post;

class PostRepository extends EloquentRepository implements PostRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Post::class;
    }

    
    public function paginate(array $filter, array $relationCondition = [], array $relations = [], int $paginate = 10)
    {

        $this->getQueryBuilder();

        $this->applyFilters($filter);

        foreach($relationCondition as $relation => $condition){
            $this->instance = $this->instance->whereHas($relation, $condition);
        }

        return $this->instance->published()->with($relations)->paginate($paginate);
    }

    public function findOrFailWithRelations($id, array $relations = ['categories']){
        $this->findOrFail($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }
    
    public function attachCategories(Post $post, array $categoriesId){
        return $post->categories()->attach($categoriesId);
    }

    public function syncCategories(Post $post, array $categoriesId){
        return $post->categories()->sync($categoriesId);
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function getByLimit(array $filter, array $filterRelation = [], array $relations = [], int $limit = 10, array $sort = ['id', 'desc'])
    {

        $this->getQueryBuilder();

        $this->applyFilters($filter);

        foreach ($filterRelation as $relation => $condition) {
            $this->instance = $this->instance->whereHas($relation, $condition);
        }

        return $this->instance->published()->with($relations)->limit($limit)->orderBy(...$sort)->get();
    }
}