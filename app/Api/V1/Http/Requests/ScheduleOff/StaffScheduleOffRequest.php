<?php

namespace App\Api\V1\Http\Requests\ScheduleOff;

use App\Admin\Http\Requests\BaseRequest;

class StaffScheduleOffRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'note' => ['required', 'string'],
            'date_off' => [ 'required','date'],

        ];
    }

    protected function methodDelete(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\ScheduleOff,id'],
        ];
    }


}
