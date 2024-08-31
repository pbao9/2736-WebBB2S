<?php

namespace App\Repositories\Setting;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface SettingRepositoryInterface extends EloquentRepositoryInterface
{
    public function getAllBySettingGroup($settingGroup);

    public function getValueByKey($key);

    public function find($id);

    public function findOrFail($id);

    public function create(array $data);

    public function update($id, array $data);
    public function delete($id);
    public function getQueryBuilder();
}