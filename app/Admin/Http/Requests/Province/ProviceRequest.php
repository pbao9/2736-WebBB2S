<?php

namespace App\Admin\Http\Requests\Province;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\School\ProvinceActive;
use App\Enums\School\SchoolStatus;
use Illuminate\Validation\Rules\Enum;


class ProvinceRequest extends BaseRequest
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
            'code' => ['required'],
            'codename' => ['nullable'],
            'phonecode' => ['nullable'],
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\School,id'],
            'name' => ['required', 'string'],
            'active' => ['nullable',  new Enum(ProvinceActive::class)],
            'code' => ['required'],
            'codename' => ['nullable'],
            'phonecode' => ['nullable'],
        ];
    }
}
