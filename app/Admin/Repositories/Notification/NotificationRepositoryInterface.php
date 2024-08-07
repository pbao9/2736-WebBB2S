<?php

namespace App\Admin\Repositories\Notification;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface NotificationRepositoryInterface extends EloquentRepositoryInterface
{

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10);

    public function getNotificationsByField($field, $value, $limit = 10): mixed;

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}
