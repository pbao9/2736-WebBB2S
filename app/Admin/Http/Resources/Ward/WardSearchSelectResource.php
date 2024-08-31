<?php


namespace App\Admin\Http\Resources\Ward;

use Illuminate\Http\Resources\Json\JsonResource;

class WardSearchSelectResource extends JsonResource
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
            'id' => $this->code,
            'text' => $this->name
        ];
    }
}
