<?php

namespace App\Admin\Services\District;

use App\Admin\Repositories\District\DistrictRepositoryInterface;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;

class DistrictService implements DistrictServiceInterface
{
    use UseLog;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected array $data;

    protected DistrictRepositoryInterface $repository;

    public function __construct(DistrictRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function store(Request $request)
    {
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