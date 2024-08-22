<?php

namespace App\Admin\Services\School;

use App\Admin\Repositories\Province\ProvinceRepositoryInterface;
use App\Admin\Repositories\School\SchoolRepositoryInterface;
use App\Admin\Services\Province\ProvinceServiceInterface;
use App\Imports\SchoolImport;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ProvinceService implements ProvinceServiceInterface
{
    use UseLog;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected array $data;
    
    protected ProvinceRepositoryInterface $repository;

    public function __construct(ProvinceRepositoryInterface $repository){
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function store(Request $request){

        $data = $request->validated();
		return $this->repository->create($data);
    }

    public function update(Request $request): object
    {
        
        $data = $request->validated();

        return $this->repository->update($data['id'], $data);

    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}