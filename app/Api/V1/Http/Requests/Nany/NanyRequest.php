<?php

namespace App\Api\V1\Http\Requests\Nany;

use App\Api\V1\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class NanyRequest extends BaseRequest
{
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
            'id_card' => [
                'nullable', 'digits:12',
                Rule::unique('nannies', 'id_card')->ignore($this->user()->id, 'user_id')
            ],
            'id_card_front' => ['nullable'],
            'id_card_back' => ['nullable'],
            'id_card_date' => ['nullable'],
        ];
    }
}
