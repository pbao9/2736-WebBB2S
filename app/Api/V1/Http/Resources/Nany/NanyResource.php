<?php

namespace App\Api\V1\Http\Resources\Nany;

use App\Api\V1\Http\Resources\Auth\AuthResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->resource['nany']->id,
            'user' => new AuthResource($this->resource['user']),
            'current_address' => $this->resource['nany']->current_address,
            'current_lat' => $this->resource['nany']->current_lat,
            'current_lng' => $this->resource['nany']->current_lng,
            'id_card' => $this->resource['nany']->id_card,
            'id_card_date' => $this->resource['nany']->id_card_date,
            'id_card_front' => $this->resource['nany']->id_card_front,
            'id_card_back' => $this->resource['nany']->id_card_back,
        ];
    }
}
