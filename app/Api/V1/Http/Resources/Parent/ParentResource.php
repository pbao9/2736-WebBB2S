<?php

namespace App\Api\V1\Http\Resources\Parent;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        $roles = $this->roles->pluck('name');
        return [
            'id' => $this->parent->id,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'avatar' => formatImageUrl($this->avatar),
            'gender' => $this->gender,
            'active' => $this->active,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'area_id' => $this->area_id,
            'notification_preference' => $this->notification_preference,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'roles' => $roles
        ];
    }
}
