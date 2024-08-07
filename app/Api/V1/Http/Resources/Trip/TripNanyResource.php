<?php

namespace App\Api\V1\Http\Resources\Trip;

use App\Api\V1\Http\Resources\Auth\AuthResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripNanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->user->fullname,
            'phone' => $this->user->phone,
            'id_card' => $this->id_card,
            'current_location' => [
                'latitude' => $this->current_lat,
                'longitude' => $this->current_lng,
                'address' => $this->current_address,
            ],
            'user' => new AuthResource($this->user)
        ];
    }


}
