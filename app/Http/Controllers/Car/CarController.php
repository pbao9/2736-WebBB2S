<?php

namespace App\Http\Controllers\Car;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarController extends Controller
{
    protected $repoMenu;
    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'public.car.index',
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
