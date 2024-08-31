<?php

namespace App\Api\V1\Http\Requests\Trip;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\Contract\ContractType;
use App\Enums\Session\Session;
use App\Enums\Trip\TripStatus;
use Illuminate\Validation\Rules\Enum;

class TripRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPatch(): array
    {
        return [
            'id' => 'required|exists:trips,id',
            'status' => ['required', new Enum(TripStatus::class)],
        ];
    }

    protected function methodGet(): array
    {
        return [
            'type' => ['nullable'],
            'status' => ['nullable'],
            'session' => ['nullable'],
            'page' => ['nullable', 'integer', 'min:1'],
            'limit' => ['nullable', 'integer', 'min:1'],
            'date' => ['nullable', 'date']
        ];
    }
}
