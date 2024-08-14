<?php

namespace App\Admin\Services\Post;

use  App\Admin\Repositories\Post\PostRepositoryInterface;
use App\Enums\Post\FeaturedStatus;
use App\Enums\Post\PostType;
use App\Enums\Post\PriorityStatus;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class PostService implements PostServiceInterface
{
    use UseLog;

    /**
     * Current Object instance
     *
     * @var array
     */
    protected array $data;

    protected PostRepositoryInterface $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {

        $data = $request->validated();
        $data['post_type'] = PostType::Default;
        $data['posted_at'] = now();
        // $data['priority'] = PriorityStatus::NotPriority;
        // if ($data['is_featured'] == 0) {
        //     $data['is_featured'] = FeaturedStatus::Featureless;
        // }
        $categoriesId = $data['categories_id'] ?? [];
        unset($data['categories_id']);
        DB::beginTransaction();
        try {
            $post = $this->repository->create($data);
            if ($categoriesId) {
                $this->repository->attachCategories($post, $categoriesId);
            }
            DB::commit();
            return $post;
        } catch (Throwable $e) {
            DB::rollBack();
            $this->logError('Failed to process create post CMS', $e);
            return false;
        }
    }

    public function update(Request $request): object|bool
    {
        $data = $request->validated();
        $categoriesId = $data['categories_id'] ?? [];
        unset($data['categories_id']);
        DB::beginTransaction();
        try {
            $post = $this->repository->update($data['id'], $data);

            $this->repository->syncCategories($post, $categoriesId);
            DB::commit();
            return $post;
        } catch (Throwable $e) {
            DB::rollBack();
            $this->logError('Failed to process update post CMS', $e);
            return false;
        }
    }


    /**
     * @throws Exception
     */
    public function delete($id): object|bool
    {
        return $this->repository->delete($id);

    }

}
