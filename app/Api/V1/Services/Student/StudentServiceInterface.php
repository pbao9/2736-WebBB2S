<?php

namespace App\Api\V1\Services\Student;

use Illuminate\Http\Request;

interface StudentServiceInterface
{


    public function update(Request $request);

    public function delete(Request $request);

    public function getScheduleForStudent($studentId);

    public function createScheduleOff(Request $request);

}
