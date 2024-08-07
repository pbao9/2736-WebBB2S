<?php

namespace App\Admin\Http\Controllers\Dashboard;

use App\Admin\Http\Controllers\Controller;
use App\Models\Contact;

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
        return view(
            $this->view['index'],
            [
                'countContact' => $countContact
            ]
        );
    }

}
