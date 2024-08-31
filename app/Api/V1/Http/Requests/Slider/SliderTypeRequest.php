<?php

namespace App\Api\V1\Http\Requests\Slider;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\Slider\SliderType;
use Illuminate\Validation\Rules\Enum;

class SliderTypeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet(): array
    {
        return [
            'type' => ['required', new Enum(SliderType::class)]
        ];
    }
}