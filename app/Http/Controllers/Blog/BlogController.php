<?php

namespace App\Http\Controllers\Blog;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Post\PostRepositoryInterface;
use App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $repoMenu;
    protected $repoPost;
    protected $repoCat;
    public function __construct(
        PostRepositoryInterface $repoPost,
        PostCategoryRepositoryInterface $repoCat,
    ) {
        parent::__construct();

        $this->repoPost = $repoPost;
        $this->repoCat = $repoCat;
    }

    public function getView()
    {
        return [
            'index' => 'public.blog.index',
            'detail' => 'public.blog.show',
            'cate' => 'public.posts.post-by-cate',
            'blog-1' => 'public.blog.blog-1',
            'blog-2' => 'public.blog.blog-2',
            'blog-3' => 'public.blog.blog-3',
        ];
    }

    public function getRoute()
    {
        return [];
    }


    public function index()
    {
        $posts = $this->repoPost->paginate([], [], []);
        $breadcrums = [['label' => trans('Tin tức')]];

        return view($this->view['index'], [
            'posts' => $posts,
            'breadcrums' => $breadcrums,
        ]);
    }

    public function blog1()
    {
        return view($this->view['blog-1']);
    }
    public function blog2()
    {
        return view($this->view['blog-2']);
    }
    public function blog3()
    {
        return view($this->view['blog-3']);
    }

    public function showPost($slug)
    {

        $posts = $this->repoPost->findBy(['slug' => $slug], ['posts', 'categories']);

        $breadcrums = [
            ['label' => $posts->title]
        ];

        $related = $this->repoPost->getByLimit([
            ['id', '!=', $posts->id]
        ], [
            'categories' => fn ($q) => $q->whereIn('id', $posts->categories->pluck('id')->toArray())
        ], [], 5);

        return view($this->view['detail'], [
            'posts' => $posts,
            'related' => $related,
            'breadcrums' => $breadcrums,
        ]);
    }
}
