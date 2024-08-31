<?php

namespace App\Api\V1\Http\Resources\TripDetail;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripDetailNotStudentResource extends JsonResource
{
    public $order;

    public function __construct($resource, $order = null)
    {
        parent::__construct($resource);
        $this->order = $order;
    }
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
            'order' => $this->order,
            'trip_id' => $this->trip_id,
            'student_id' => $this->student_id,
            'picked_up' => $this->picked_up,
            'pickup_time' => $this->pickup_time,
            'student_image' => formatImageUrl($this->student_image),
            'skip_reason' => $this->skip_reason,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,


        ];
    }
}
