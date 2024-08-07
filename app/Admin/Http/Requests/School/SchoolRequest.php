<?php

namespace App\Admin\Http\Requests\School;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\School\SchoolStatus;
use Illuminate\Validation\Rules\Enum;


class SchoolRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'name' => ['required', 'string'],
            'province_code' => ['required', 'string'],
            'district_code' => ['required', 'string'],
            'address' => ['required'],
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\School,id'],
            'name' => ['required', 'string'],
            'province_code' => ['required', 'string'],
            'district_code' => ['required', 'string'],
            'address' => ['required'],
            'status' => ['required',  new Enum(SchoolStatus::class)]
        ];
    }
}
