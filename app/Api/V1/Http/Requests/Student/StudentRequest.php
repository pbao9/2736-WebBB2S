<?php

namespace App\Api\V1\Http\Requests\Student;

use App\Admin\Http\Requests\BaseRequest;

class StudentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'id' => ['nullable', 'exists:App\Models\Student,id'],
            'fullname' => ['required', 'string'],
            'name_other' => ['nullable', 'string'],
            'phone_other' => [
                'nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
            ],
            'note' => ['nullable'],
            'grade' => ['required'],
            'grade_detail' => ['required'],
            'avatar' => ['nullable']
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['nullable', 'exists:App\Models\Student,id'],
            'fullname' => ['nullable', 'string'],
            'name_other' => ['nullable', 'string'],
            'phone_other' => [
                'nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
            ],
            'note' => ['nullable'],
            'grade' => ['nullable'],
            'grade_detail' => ['nullable'],
            'avatar' => ['nullable']
        ];
    }
}
