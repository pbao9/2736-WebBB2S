<?php

namespace App\Api\V1\Repositories\Contract;

use App\Admin\Repositories\EloquentRepository;
use App\Models\Contract;

class ContractRepository extends EloquentRepository implements ContractRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Contract::class;
    }

    public function findWithDetail($id, $parentId)
    {
        $this->findOrFail($id);
        $this->instance = $this->instance->load('detail', 'school');
        $this->instance->detail = $this->instance->detail->reject(function ($detail) use ($parentId) {
            if($detail->parent_id == $parentId){
                return false;
            }
            return true;
        });
        return $this->instance;
    }

    public function getAllContractParent($id)
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->whereHas('detail', function ($query) use ($id) {
            $query->where('parent_id', $id);
        })->get();
        return $this->instance;
    }
}
