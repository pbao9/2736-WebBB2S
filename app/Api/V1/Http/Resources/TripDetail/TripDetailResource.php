<?php

namespace App\Api\V1\Http\Resources\TripDetail;

use App\Api\V1\Http\Resources\Student\StudentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripDetailResource extends JsonResource
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
            'trip_id' => $this->trip_id,
            'student_id' => $this->student_id,
            'picked_up' => $this->picked_up,
            'pickup_time' => $this->pickup_time,
            'student_image' => formatImageUrl($this->student_image),
            'skip_reason' => $this->skip_reason,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'student' => new StudentResource($this->student)


        ];
    }
}
