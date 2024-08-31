<?php

namespace App\Admin\Http\Controllers\Setting;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Setting\SettingRequest;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Setting\SettingGroup;

class SettingController extends Controller
{
    public function __construct(
        SettingRepositoryInterface $repository
    ) {
        parent::__construct();
        $this->repository = $repository;
    }
    public function getView()
    {
        return [
            'general' => 'admin.settings.general',
            'company' => 'admin.settings.company',
            'user_shopping' => 'admin.settings.user-shopping',
        ];
    }
    public function general()
    {
        $settings = $this->repository->getByGroup([SettingGroup::General]);
        return view($this->view['general'], compact('settings'));
    }

    public function company()
    {
        $settings = $this->repository->getByGroup([SettingGroup::Company]);
        return view($this->view['company'], compact('settings'));
    }


    public function update(SettingRequest $request)
    {
        $data = $request->validated();
        $this->repository->updateMultipleRecord($data);
        return back()->with('success', __('notifySuccess'));
    }
}