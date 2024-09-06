<?php

namespace App\Services\Contact;

use App\Repositories\Contact\ContactRepositoryInterface;
use App\Services\Contact\ContactServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContactService implements ContactServiceInterface
{
    protected $repository;
    protected $data;

    public function __construct(ContactRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validated();
        if ($data['form_type'] == 0 && $data['school_other'] != 0) {
            unset($data['school_id']);
        }
        return $this->repository->create($data);
    }
}
