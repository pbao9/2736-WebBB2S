<?php


namespace App\Admin\Http\Controllers\Address\Address\Province;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Repositories\Province\ProvinceRepositoryInterface;
use App\Admin\Http\Resources\Province\ProvinceSearchSelectResource;



class ProvinceSearchController extends BaseSearchSelectController
{

     public function __construct(ProvinceRepositoryInterface $repository)
     {
        $this->repository = $repository;
     }


     protected function selectResponse(){
         $this->instance = [
            'results' => ProvinceSearchSelectResource::collection($this->instance)
        ];
    }



}
