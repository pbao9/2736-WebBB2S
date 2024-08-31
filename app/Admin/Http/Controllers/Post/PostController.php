<?php

namespace App\Admin\Http\Controllers\Post;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Post\PostRequest;
use App\Admin\Repositories\Post\PostRepositoryInterface;
use App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface;
use App\Admin\Services\Post\PostServiceInterface;
use App\Admin\DataTables\Post\PostDataTable;
use App\Admin\Traits\ResponseController;
use App\Enums\Post\FeaturedStatus;
use App\Enums\Post\PostStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    use ResponseController;

    protected PostCategoryRepositoryInterface $repositoryPostCategory;

    public function __construct(
        PostRepositoryInterface         $repository,
        PostCategoryRepositoryInterface $repositoryPostCategory,
        PostServiceInterface            $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->repositoryPostCategory = $repositoryPostCategory;

        $this->service = $service;
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.posts.index',
            'create' => 'admin.posts.create',
            'edit' => 'admin.posts.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.post.index',
            'create' => 'admin.post.create',
            'edit' => 'admin.post.edit',
            'delete' => 'admin.post.delete'
        ];
    }

    public function index(PostDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('post'),route($this->route['index'])),
            'status' => PostStatus::asSelectArray(),
        ]);
    }

    public function create(): Factory|View|Application
    {
        $categories = $this->repositoryPostCategory->getFlatTree();
        return view($this->view['create'], [
            'categories' => $categories,
            'breadcrumbs' => $this->crums->add(__('post'),route($this->route['index']))->add(__('add')),
            'status' => PostStatus::asSelectArray()
        ]);
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $response = $this->service->store($request);
        return $this->handleResponse($response, $request, $this->route['index'], $this->route['edit']);
    }

    public function edit($id): Factory|View|Application
    {
        $categories = $this->repositoryPostCategory->getFlatTree();

        $post = $this->repository->findOrFailWithRelations($id);
        return view(
            $this->view['edit'],
            [
                'categories' => $categories,
                'post' => $post,
                'status' => PostStatus::asSelectArray(),
                'featured_status' => FeaturedStatus::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('post'),route($this->route['index']))->add(__('edit')),
            ],
        );
    }

    public function update(PostRequest $request): RedirectResponse
    {
        $response = $this->service->update($request);
        return $this->handleUpdateResponse($response);
    }

    public function delete($id): RedirectResponse
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
