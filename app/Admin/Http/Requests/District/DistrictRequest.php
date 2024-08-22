<?php

namespace App\Admin\Http\Requests\District;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Province\ProvinceActive;
use Illuminate\Validation\Rules\Enum;


class DistrictRequest extends BaseRequest
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
            'code' => ['required', 'unique:App\Models\District,code'],
            'province_code' => ['required'],
            'division_type' => ['nullable'],
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\District,id'],
            'name' => ['required', 'string'],
            'code' => ['required', 'unique:App\Models\District,code,' . $this->id],
            'province_code' => ['required'],
            'division_type' => ['nullable'],
        ];
    }
}
