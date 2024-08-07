<?php

namespace App\Api\V1\Http\Resources\Driver;

use App\Api\V1\Http\Resources\Auth\AuthResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class DriverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'user' => new AuthResource($this->resource['user']),
            'id' => $this->resource['driver']->id,
            'id_card' => $this->resource['driver']->id_card,
            'id_card_front' => $this->resource['driver']->id_card_front,
            'id_card_back' => $this->resource['driver']->id_card_back,
            'driver_license_front' => $this->resource['driver']->driver_license_front,
            'driver_license_back' => $this->resource['driver']->driver_license_back,
            'bank_name' => $this->resource['driver']->bank_name,
            'bank_account_name' => $this->resource['driver']->bank_account_name,
            'bank_account_number' => $this->resource['driver']->bank_account_number,
            'current_lat' => $this->resource['driver']->current_lat,
            'current_lng' => $this->resource['driver']->current_lng,
            'current_address' => $this->resource['driver']->current_address,
            'order_accepted' => $this->resource['driver']->order_accepted,
            'is_locked' => $this->resource['driver']->is_locked,
            'is_on' => $this->resource['driver']->is_on,
        ];
    }
}
