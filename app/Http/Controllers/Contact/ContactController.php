<?php

namespace App\Http\Controllers\Contact;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Contact\ContactRequest;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Mail\ContactForm;
use App\Repositories\Contact\ContactRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Services\Contact\ContactServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    protected $repositorySetting;
    protected $repositoryProvince;

    public function __construct(
        ContactRepositoryInterface $repository,
        ContactServiceInterface    $service,
        SettingRepositoryInterface $repositorySetting,
    ) {
        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
        $this->repositorySetting = $repositorySetting;
    }

    public function store(ContactRequest $request)
    {
        // dd($request);
        $response = $this->service->store($request);
        $data = $request->validated();
        if ($response) {
            $mailTo = $this->repositorySetting->getValueByKey('email');
            Mail::to($mailTo)->send(new ContactForm($data));

            return response()->json(['success' => true, 'message' => __('Đã gửi liên hệ thành công!')]);
        } else {
            return response()->json(['success' => false, 'message' => __('notifyFail')]);
        }
    }
}
