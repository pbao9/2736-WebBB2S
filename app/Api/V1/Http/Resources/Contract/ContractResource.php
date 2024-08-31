<?php

namespace App\Api\V1\Http\Resources\Contract;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
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
            'id' => $this->id,
            'nany_id' => $this->nany_id,
            'school_id' => $this->school_id,
            'driver_id' => $this->driver_id,
            'totalStudent' => $this->total,
            'status' => $this->status,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'expired_at' => $this->expired_at,
            'schedule' => json_decode($this->schedule),
            'session_arrive_school' => $this->session_arrive_school,
            'session_off' => $this->session_off,
            'time_arrive_school' => $this->time_arrive_school,
            'time_off' => $this->time_off,
            'detail' => $this->detail->toArray(),
            'school' => $this->school,
            'nany' => $this->nany->user,
            'driver' => $this->driver->user,
        ];
    }
}
