<?php

namespace App\Admin\Http\Requests\Setting;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\User\Gender;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class SettingRequest extends BaseRequest
{
    protected function methodPut(): array
    {
        return [
            'site_name' => ['required'],
            'site_logo' => ['nullable'],
            'banner_on_app' => ['nullable'],
            'zalo' => [
                'required',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
            ],
            'email' => ['required', 'email'],
            'hotline' => [
                'required',
                // 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'
            ],
            'hotline-1' => [
                'required',
                // 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'
            ],
            'slot_seat' => [
                'required',
                'int'
            ],
            'info' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
        ];
    }
}
