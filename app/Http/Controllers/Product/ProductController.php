<?php

namespace App\Http\Controllers\Product;

use App\Admin\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $repoMenu;
    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'public.product.index',
        ];
    }

    public function getRoute()
    {
        return [];
    }

    public function index()
    {
        return view($this->view['index']);
    }
}
