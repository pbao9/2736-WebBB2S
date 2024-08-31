<?php

namespace App\Api\V1\Http\Requests\Parent;

use App\Api\V1\Http\Requests\BaseRequest;

class TripParentRequest extends BaseRequest
{

    protected function methodGet(): array
    {
        return [
            'id' => 'required|exists:trip_details,id',
            'trip_date' => 'required'
        ];
    }


}
