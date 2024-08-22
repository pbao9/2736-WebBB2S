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
            'site_name' => ['nullable'],
            'site_logo' => ['nullable'],
            'banner_on_app' => ['nullable'],
            'email' => ['nullable', 'email'],
            'hotline' => [
                'nullable',
                // 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'
            ],
            'hotline-1' => [
                'nullable',
                // 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'
            ],
            'slot_seat' => [
                'nullable',
                'int'
            ],
            'info' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string'],
            'tax_code' => ['nullable', 'string'],
            'company' => ['nullable', 'string'],
            'introduce' => ['nullable', 'string'],
            'video' => ['nullable', 'max:102400'], // max 100MB
            'slogan' => ['nullable', 'string'],
            'ch_play_link' => ['nullable', 'string'],
            'app_store_link' => ['nullable', 'string'],
        ];
    }
}
