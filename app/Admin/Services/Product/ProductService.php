<?php

namespace App\Admin\Services\Product;

use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Services\Product\ProductServiceInterface;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductService implements ProductServiceInterface
{
    use UseLog;

    /**
     * Current Object instance
     *
     * @var array
     */
    protected array $data;

    protected ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {

        $data = $request->validated();
        $data['posted_at'] = now();

        return $this->repository->create($data);
    }

    public function update(Request $request): object|bool
    {
        $data = $request->validated();
        return $this->repository->update($data['id'], $data);
    }


    /**
     * @throws Exception
     */
    public function delete($id): object|bool
    {
        return $this->repository->delete($id);
    }
}
