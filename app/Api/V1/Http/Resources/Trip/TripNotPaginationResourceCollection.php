<?php

namespace App\Api\V1\Http\Resources\Trip;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TripNotPaginationResourceCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'trips' => $this->collection->map(function ($instance) {
                return new TripDetailForParentResource($instance);
            }),

        ];
    }
}
