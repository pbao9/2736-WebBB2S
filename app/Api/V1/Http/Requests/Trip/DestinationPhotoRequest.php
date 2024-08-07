<?php

namespace App\Api\V1\Http\Requests\Trip;

use App\Api\V1\Http\Requests\BaseRequest;


class DestinationPhotoRequest extends BaseRequest
{

    protected function methodPost(): array
    {
        return [
            'id' => 'required|exists:trips,id',
            'destination_photo' => ['required', 'image'],
        ];
    }
}
