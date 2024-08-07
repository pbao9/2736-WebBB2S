<?php

namespace App\Api\V1\Services\Trip;

use Illuminate\Http\Request;

interface TripServiceInterface
{
    public function getTripsByStaff(Request $request);

    public function getTripDetails(int $id);

    public function updateStudentArrivalSchool(Request $request);

    public function startTrip(Request $request);

    public function startTripFromSchool(Request $request);

    public function endTrip(Request $request);

    public function updateLocation(Request $request);

}
