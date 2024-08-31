<?php

namespace App\Admin\Http\Requests\Parent;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\User\Gender;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ParentRequest extends BaseRequest
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
            'phone' => [
                'required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
                'unique:App\Models\User,phone'
            ],
            'email' => [
                'required',
                'email',
                'unique:App\Models\User,email'
            ],
            'address' => ['nullable'],
            'birthday' => ['required'],
            'gender' => ['required', new Enum(Gender::class)],
            'password' => ['required', 'string', 'confirmed'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'avatar' => ['nullable']

        ];
    }

    public function instance()
    {
        return User::find($this->id);
    }

    protected function methodPut(): array
    {
        $item = $this->instance();
        $user_id = $item->id;
        return [
            'id' => ['required', 'exists:App\Models\User,id'],
            'fullname' => ['required', 'string'],
            'phone' => [
                'required',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
                Rule::unique('users', 'phone')->ignore($user_id, 'id'),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user_id, 'id')
            ],
            'address' => ['nullable'],
            'gender' => ['required', new Enum(Gender::class)],
            'password' => ['nullable', 'string', 'confirmed'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'avatar' => ['nullable'],
        ];
    }
}
