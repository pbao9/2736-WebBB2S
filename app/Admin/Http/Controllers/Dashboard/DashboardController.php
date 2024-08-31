<?php

namespace App\Admin\Http\Controllers\Dashboard;

use App\Admin\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Product;
use App\Models\School;

class DashboardController extends Controller
{
    //

    public function getView()
    {
        return [
            'index' => 'admin.dashboard.index'
        ];
    }
    public function index()
    {
        $countContact = Contact::count();
        $countPost = Post::count();
        $countSchool = School::count();
        $countProduct = Product::count();
        return view(
            $this->view['index'],
            [
                'countContact' => $countContact,
                'countPost' => $countPost,
                'countSchool' => $countSchool,
                'countProduct' => $countProduct
            ]
        );
    }

}
