<?php

namespace App\Http\Controllers\Blog;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $repoMenu;
    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'blog-1' => 'public.blog.blog-1',
            'blog-2' => 'public.blog.blog-2',
            'blog-3' => 'public.blog.blog-3',
        ];
    }

    public function getRoute()
    {
        return [];
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
}
