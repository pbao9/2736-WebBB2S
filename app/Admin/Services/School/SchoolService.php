<?php

namespace App\Admin\Services\School;

use App\Admin\Repositories\School\SchoolRepositoryInterface;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;


class SchoolService implements SchoolServiceInterface
{
    use UseLog;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected array $data;
    
    protected SchoolRepositoryInterface $repository;

    public function __construct(SchoolRepositoryInterface $repository){
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function store(Request $request){

        $data = $request->validated();
        // $data['longitude'] = $data['lng'];
        // $data['latitude'] = $data['lat'];

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