<?php

namespace App\Admin\Http\Resources\School;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolSearchSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->name . ' - '. $this->address
        ];
    }
}
