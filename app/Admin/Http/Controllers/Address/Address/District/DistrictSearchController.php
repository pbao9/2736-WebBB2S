<?php


namespace App\Admin\Http\Controllers\Address\Address\District;


use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Repositories\District\DistrictRepositoryInterface;
use App\Admin\Http\Resources\District\DistrictSearchSelectResource;
use Illuminate\Http\Request;

class  DistrictSearchController extends BaseSearchSelectController
{

    protected $request;
    protected $instance;
    public function __construct(DistrictRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function selectResponse()
    {
        $this->instance = [
            'results' => DistrictSearchSelectResource::collection($this->instance)
        ];
    }


    public function selectDistrict(Request $request)
    {
        $this->request = $request;
        $this->data();
        $this->selectResponse();
        return $this->instance;
    }

    protected function data()
    {
        $this->instance = $this->repository->searchAllLimit(
            $this->request->input('province_code'),
            $this->request->input('term', ''),
            $this->request->except('term', '_type', 'q')
        );
    }
}
