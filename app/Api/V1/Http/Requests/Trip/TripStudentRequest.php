<?php

namespace App\Api\V1\Http\Requests\Trip;

use App\Api\V1\Http\Requests\BaseRequest;

class TripStudentRequest extends BaseRequest
{
    protected function methodGet(): array
    {
        return [
            'date' => ['required', 'date'],
            'student_id' => ['required', 'exists:App\Models\Student,id'],
        ];
    }

    public function methodPost(): array
    {
        return [
            'id' => 'required|exists:trip_details,id',
            'skip_reason' => ['nullable', 'string'],
        ];
    }
}
