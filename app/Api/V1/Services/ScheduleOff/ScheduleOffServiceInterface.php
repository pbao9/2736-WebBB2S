<?php

namespace App\Api\V1\Services\ScheduleOff;

use Illuminate\Http\Request;

interface ScheduleOffServiceInterface
{
    public function createScheduleOff(Request $request);
    public function getSchedule();
    public function delete($id);
    public function restore($id);

}
