<?php


namespace App\Admin\Http\Controllers\Address\Address\Ward;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Ward\WardSearchSelectResource;
use App\Admin\Repositories\Ward\WardRepositoryInterface;


class WardSearchController extends BaseSearchSelectController
{

    public function __construct(WardRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    protected function selectResponse()
    {
        $this->instance = [
            'results' => WardSearchSelectResource::collection($this->instance)
        ];
    }


}
