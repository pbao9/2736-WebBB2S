<?php

namespace App\Api\V1\Services\TripDetail;

use Illuminate\Http\Request;

interface TripDetailServiceInterface
{
    public function checkPickupStatus(Request $request);

    public function notifyParentOfArrival(Request $request);

    public function endTrip(Request $request);

    public function getTripsByStudentId(Request $request);

    public function skipStudent(Request $request);
    public function updateStudentArrivalHome(Request $request);

}
