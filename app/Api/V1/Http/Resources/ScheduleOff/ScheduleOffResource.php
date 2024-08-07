<?php

namespace App\Api\V1\Http\Resources\ScheduleOff;

use App\Api\V1\Http\Resources\Student\StudentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleOffResource extends JsonResource
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
            'student_id' => $this->student_id,
            'date_off' => $this->date_off,
            'note' => $this->note,
            'status' => $this->status,
            'student' => new StudentResource($this->student),
            'driver' => $this->driver ?? null,
            'nany' => $this->nany ?? null
        ];
    }


}
