<?php

namespace App\Admin\Repositories\Contact;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface ContactRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10);

}
