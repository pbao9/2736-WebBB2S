<?php

namespace App\Api\V1\Http\Requests\TripDetail;

use App\Api\V1\Http\Requests\BaseRequest;


class NotifyParentOfArrivalRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'id' => 'required|exists:trip_details,id',
            'current_address' => 'required|string|max:255',
            'current_lat' => 'required|numeric',
            'current_lng' => 'required|numeric'
        ];
    }


}
