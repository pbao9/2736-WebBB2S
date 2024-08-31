<?php

namespace App\Http\Controllers\Home;

use App\Admin\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $repoMenu;
    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'public.home.index',
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
