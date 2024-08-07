<?php

namespace App\Api\V1\Http\Resources\Slider;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SliderResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($instance) {
            return new SliderResource($instance);
        });
    }
}
