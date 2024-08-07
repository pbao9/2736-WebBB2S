<?php

namespace App\Admin\Http\Requests\Slider;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Slider\SliderStatus;
use App\Enums\Slider\SliderType;
use Illuminate\Validation\Rules\Enum;

class SliderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'status' => ['required', new Enum(SliderStatus::class)],
            'type' => ['required', new Enum(SliderType::class)],
            'name' => ['required', 'string'],
            'plain_key' => ['required', 'string', 'unique:App\Models\Slider,plain_key'],
            'desc' => ['nullable'],
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\Slider,id'],
            'type' => ['required', new Enum(SliderType::class)],
            'status' => ['required', new Enum(SliderStatus::class)],
            'name' => ['required', 'string'],
            'plain_key' => ['required', 'string', 'unique:App\Models\Slider,plain_key,'.$this->id],
            'desc' => ['nullable'],
        ];
    }
}