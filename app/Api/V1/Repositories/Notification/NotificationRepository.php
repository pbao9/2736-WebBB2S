<?php

namespace App\Api\V1\Repositories\Notification;
use \App\Admin\Repositories\Notification\NotificationRepository as AdminArea;
use App\Models\Notification;

class NotificationRepository extends AdminArea implements NotificationRepositoryInterface
{
    protected $model;

    public function __construct(Notification $note)
    {
        $this->model = $note;
    }

    public function get()
    {
        return $this->model->get();
    }
    public function detail($id)
    {
        return $this->model->detail($id);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
    public function getParentNotifications($parent_id)
    {
        return $this->model->where('parent_id', $parent_id)->paginate(5);
    }
    public function getDriverNotifications($driver_id)
    {
        return $this->model->where('driver_id', $driver_id)->paginate(5);
    }

    public function getNanyNotifications($nany_id)
    {
        return $this->model->where('nany_id', $nany_id)->paginate(5);
    }
}
