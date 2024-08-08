<?php

namespace App\Admin\Http\Requests\Contact;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Contact\ContactType;
use Illuminate\Validation\Rules\Enum;


class ContactRequest extends BaseRequest
{
    protected function methodPost(): array
    {
        return [
            'name' => ['required', 'string'],
            'form_type' => ['nullable'],
            'type' => ['nullable'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'province_code' => ['nullable'],
            'district_code' => ['nullable'],
            'school_name' => ['nullable'],
            'school_address' => ['nullable'],
            'school_id' => ['nullable'],
            'school_other' => ['nullable'],
            'location' => ['nullable'],
            'time_pickup' => ['nullable'],
            'status' => ['nullable'],
            'service' => ['nullable']
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\Contact,id'],
            'name' => ['nullable', 'string'],
            'form_type' => ['nullable'],
            'type' => ['nullable'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'province_code' => ['nullable'],
            'district_code' => ['nullable'],
            'school_name' => ['nullable'],
            'school_address' => ['nullable'],
            'school_id' => ['nullable'],
            'location' => ['nullable'],
            'time_pickup' => ['nullable'],
            'status' => ['nullable']
        ];
    }
}
