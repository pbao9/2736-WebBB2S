<?php

namespace App\Api\V1\Http\Resources\Student;

use App\Api\V1\Http\Resources\School\SchoolResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return $this->collection->map(function($item){
            return [
                'id' => $item->id,
                'fullname' => $item->fullname,
                'avatar' => formatImageUrl($item->avatar),
                'schedule' => json_decode($item->schedule),
                'phone' => $item->phone,
                'name_other' => $item->name_other,
                'phone_other' => $item->phone_other,
                'note' => $item->note,
                'grade' => $item->grade,
                'created_at' => $item->created_at,
                'schools' => SchoolResource::collection($item->schools),
            ];
        });
    }
}
