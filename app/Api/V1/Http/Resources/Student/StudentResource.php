<?php

namespace App\Api\V1\Http\Resources\Student;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'avatar' => formatImageUrl($this->avatar),
            'phone' => $this->phone,
            'name_other' => $this->name_other,
            'phone_other' => $this->phone_other,
            'note' => $this->note,
            'grade' => $this->grade,
            'created_at' => $this->created_at,
        ];
    }
}
