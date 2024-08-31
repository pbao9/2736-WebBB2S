<?php
namespace App\Repositories\Setting;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Setting\SettingRepository as AdminSettingRepository;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingRepository extends AdminSettingRepository implements SettingRepositoryInterface
{
    protected $select = [];
    public function getModel()
    {
        return Setting::class;
    }

    public function getAllBySettingGroup($settingGroup)
    {
        $this->instance = $this->model->pluck('plain_value', 'setting_key');
        return $this->getInstance();
    }

    public function getValueByKey($key)
    {
        $this->getAllBySettingGroup($key);
        return $this->instance[$key] ?? '';
    }

    public function findOrFail($id)
    {
        $this->instance = $this->model->findOrFail($id);
        return $this->instance;
    }
}