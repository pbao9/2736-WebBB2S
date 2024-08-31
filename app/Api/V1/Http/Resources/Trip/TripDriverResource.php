<?php

namespace App\Api\V1\Http\Resources\Trip;

use App\Api\V1\Http\Resources\Auth\AuthResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripDriverResource extends JsonResource
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
            'name' => $this->getNameAttribute(),
            'phone' => $this->getPhoneAttribute(),
            'avatar' => formatImageUrl($this->avatar),
            'id_card' => $this->id_card,
            'license_plate' => $this->license_plate,
            'vehicle_company' => $this->vehicle_company,
            'vehicle_registration' => [
                'front' => $this->vehicle_registration_front,
                'back' => $this->vehicle_registration_back,
            ],
            'driver_license' => [
                'front' => $this->driver_license_front,
                'back' => $this->driver_license_back,
            ],
            'current_location' => [
                'latitude' => $this->current_lat,
                'longitude' => $this->current_lng,
                'address' => $this->current_address,
            ],
            'user' => new AuthResource($this->user)
        ];
    }


}
