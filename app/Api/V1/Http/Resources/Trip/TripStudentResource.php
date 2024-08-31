<?php

namespace App\Api\V1\Http\Resources\Trip;

use App\Api\V1\Http\Resources\TripDetail\TripDetailResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TripStudentResource extends JsonResource
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
            'id' => $this->resource['trip_detail']->id,
            'trip_id' => $this->resource['trip_detail']->contract_id,
            'student_id' => $this->resource['trip_detail']->student_id,
            'picked_up' => $this->resource['trip_detail']->picked_up,
            'check_in' => $this->resource['trip_detail']->check_in,
            'check_out' => $this->resource['trip_detail']->check_out,
            'student_image' => formatImageUrl($this->resource['trip_detail']->student_image),
            'skip_reason' => $this->resource['trip_detail']->skip_reason,
            'school' => $this->resource['trip_detail']->trip->contract->school,
            'driver' => new TripDriverResource($this->resource['trip_detail']->trip->contract->driver),
            'nany' => new TripNanyResource($this->resource['trip_detail']->trip->contract->nany),
            'student' => $this->resource['student'],
            'trip' => $this->resource['trip_detail']->trip
        ];
    }

    /**
     * Sort trip details by pickup time.
     *
     * @return AnonymousResourceCollection
     */
    protected function sortTripDetailsByTime(): AnonymousResourceCollection
    {
        $sortedDetails = $this->tripDetails->sortBy(function ($detail) {
            return $detail->pickup_time ?? Carbon::now()->addCentury();
        });
        return TripDetailResource::collection($sortedDetails);
    }
}
