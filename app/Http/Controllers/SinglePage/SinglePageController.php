<?php

namespace App\Http\Controllers\SinglePage;

use App\Admin\Http\Controllers\Controller;
use App\Enums\Contact\ContactService;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Contact\UserType;
use App\Enums\Session\Session;
use App\Models\Province;
use App\Models\School;
use Illuminate\Http\Request;

class SinglePageController extends Controller
{

    protected $repoProvince;

    public function __construct(
        ProvinceRepository $repoProvince,
    ) {
        parent::__construct();

        $this->repoProvince = $repoProvince;
    }


    public function getView()
    {
        return [
            'contact' => 'public.contact.index',
            'findcar' => 'public.car.index'
        ];
    }
    public function contact()
    {
        return view($this->view['contact']);
    }
    public function findcar()
    {
        $provinces = $this->repoProvince->get2Province();
        return view($this->view['findcar'], [
            'provinces' => $provinces,
            'type' => UserType::asSelectArray(),
            'service' => ContactService::asSelectArray(),
            'session' => Session::asSelectArray(),
        ]);
    }
}
