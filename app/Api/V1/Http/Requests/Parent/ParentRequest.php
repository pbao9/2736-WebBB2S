<?php

namespace App\Api\V1\Http\Requests\Parent;

use App\Api\V1\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ParentRequest extends BaseRequest
{

    protected function methodGet(): array
    {
        return [
            'date' => ['required', 'date']
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'fullname' => ['nullable', 'string'],
            'phone' => [
                'nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
                Rule::unique('users', 'phone')->ignore($this->user()->id, 'id')
            ],
            'avatar' => ['nullable'],
        ];
    }
}
