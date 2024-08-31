<?php

namespace App\Api\V1\Http\Resources\Trip;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TripResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'trips' => $this->collection->map(function ($instance) {
                return new TripResource($instance);
            }),
            'links' => [
                'first' => $this->url(1),
                'last' => $this->url($this->lastPage()),
                'prev' => $this->previousPageUrl(),
                'next' => $this->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $this->currentPage(),
                'from' => $this->firstItem(),
                'to' => $this->lastItem(),
                'limit' => $this->perPage(),
                'total' => $this->total(),
                'count' => $this->count(),
                'total_pages' => $this->lastPage(),
            ],
        ];
    }
}
