<?php

namespace App\View\Composers\Setting;

use App\Enums\Setting\SettingGroup;
use Illuminate\View\View;

class SettingComposer
{
    protected $repoSetting;

    public function __construct()
    {
        $this->repoSetting = app()->make('App\Repositories\Setting\SettingRepositoryInterface');
    }

    public function compose(View $view)
    {
        $settings = $this->repoSetting->getAllBySettingGroup(SettingGroup::General);
        $view->with('settings', $settings);
    }
}