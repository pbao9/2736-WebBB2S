<?php

namespace App\Api\V1\Http\Requests\Slider;

use App\Api\V1\Http\Requests\BaseRequest;

class SliderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet(): array
    {
        return [
            'key' => ['required', 'exists:App\Models\Slider,plain_key']
        ];
    }
}