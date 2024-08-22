<?php

namespace App\Admin\Http\Requests\Province;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Province\ProvinceActive;
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
            'code' => ['required', 'unique:App\Models\Province,code'],
            'phone_code' => ['required'],
            'active' => ['nullable', new Enum(ProvinceActive::class)],
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\Province,id'],
            'name' => ['required', 'string'],
            'active' => ['nullable', new Enum(ProvinceActive::class)],
            'code' => ['required', 'unique:App\Models\Province,code,' . $this->id],
            'phone_code' => ['nullable'],
        ];
    }
}
