<?php

namespace App\Admin\Repositories\Contact;

use App\Admin\Repositories\EloquentRepository;
use App\Models\Contact;

class ContactRepository extends EloquentRepository implements ContactRepositoryInterface
{
    public function getModel(): string
    {
        return Contact::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10)
    {

        $this->instance = $this->model->where('name', 'like', '%' . $keySearch . '%');

        $this->applyFilters($meta);
        return $this->instance->limit($limit)->get();
    }

}
