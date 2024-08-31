<?php

namespace App\Admin\Services\Contact;

use App\Admin\Repositories\Contact\ContactRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class ContactService implements ContactServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(ContactRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $data = $request->validated();
        return $this->repository->create($data);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request): object|bool
    {

        $data = $request->validated();
        return $this->repository->update($data['id'], $data);
    }

    public function delete($id): object|bool
    {
        return $this->repository->delete($id);
    }
}
