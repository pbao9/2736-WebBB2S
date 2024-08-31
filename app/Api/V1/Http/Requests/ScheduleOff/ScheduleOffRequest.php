<?php

namespace App\Api\V1\Http\Requests\ScheduleOff;

use App\Admin\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ScheduleOffRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'student_id' => ['required', 'exists:App\Models\Student,id'],
            'note' => ['required', 'string'],
            'date_off' => [
                'required',
                'date',
                Rule::unique('schedule_off')
                    ->where(function ($query) {
                        return $query->where('student_id', $this->student_id);
                    })
            ],
        ];
    }

    protected function methodDelete(): array
    {
        return [
            'student_id' => ['required', 'exists:App\Models\Student,id'],
            'id' => ['required', 'exists:App\Models\ScheduleOff,id'],
        ];
    }


}
