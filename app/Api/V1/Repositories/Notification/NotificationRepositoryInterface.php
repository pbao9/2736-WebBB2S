<?php

namespace App\Api\V1\Repositories\Notification;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface NotificationRepositoryInterface extends EloquentRepositoryInterface
{
    public function getAll();

    public function delete($id);
    public function getParentNotifications($parent_id);
    public function getDriverNotifications($driver_id);
    public function getNanyNotifications($nany_id);
}
