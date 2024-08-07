<?php

namespace App\Http\Controllers\SinglePage;

use App\Admin\Http\Controllers\Controller;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Contact\UserType;
use App\Models\Province;
use App\Models\School;
use Illuminate\Http\Request;

class SinglePageController extends Controller
{

    protected $repoProvince;

    public function __construct(
        ProvinceRepository $repoProvince,
    )
    {
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
        // $school = School::all();
        // $provinces = Province::all();

        $provinces = $this->repoProvince->get2Province();
        // $provinces = Province::whereIn('code', [1, 79])->get();
        return view($this->view['findcar'], [
            // 'school' => $school,
            'provinces' => $provinces,
            'type' => UserType::asSelectArray(),
        ]);
    }
}
