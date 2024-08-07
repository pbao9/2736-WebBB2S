<?php

namespace App\Http\Controllers\Process;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    protected $repoMenu;
    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'public.process.index',
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
