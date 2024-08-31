<?php

namespace App\Admin\Http\Requests\User;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\User\Gender;
use Illuminate\Validation\Rules\Enum;

class UserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [

            'fullname' => ['required', 'string'],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
                'unique:App\Models\User,phone'],
            'slug' => ['required', 'slug', 'unique:App\Models\User,slug'],
            'address' => ['nullable'],
            'birthday' => ['required'],
            'gender' => ['required', new Enum(Gender::class)],
            'password' => ['required', 'string', 'confirmed'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'avatar' => ['nullable']

        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\User,id'],
            'fullname' => ['required', 'string'],
            'slug' => ['required', 'slug', 'unique:App\Models\User,slug,' . $this->id],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
                'unique:App\Models\User,phone,' . $this->id],
            'address' => ['nullable'],
            'gender' => ['required', new Enum(Gender::class)],
            'password' => ['nullable', 'string', 'confirmed'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'avatar' => ['nullable'],
        ];
    }
}
