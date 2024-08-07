<?php

namespace App\Api\V1\Repositories\Student;

use App\Admin\Repositories\EloquentRepository;
use App\Enums\DefaultStatus;
use App\Models\Student;

class StudentRepository extends EloquentRepository implements StudentRepositoryInterface
{

    protected $select = [];

    public function getModel(): string
    {
        return Student::class;
    }


    public function getStudentIdsWithOffDay($tripDate)
    {
        return $this->model->whereHas('scheduleOff', function ($query) use ($tripDate) {
            $query->whereDate('date_off', '=', $tripDate);
        })->pluck('id')->toArray();
    }
    
    public function isChildOfParent($student_id, $parent_id)
    {
        $student = $this->model->find($student_id);
        $parent = $student->parents()->wherePivot('parent_id', $parent_id)->first();
        if($parent){
            return true;
        }
        return false;
    }

    public function deleteScheduleOff($id, $student_id)
    {
        $student = $this->model->find($student_id);

        if ($student) {
            $scheduleOff = $student->scheduleOff()->where('id', $id)->first();

            if ($scheduleOff) {
                $scheduleOff->status = DefaultStatus::Deleted;
                return $scheduleOff->save();
            }
        }

        return false;
    }
}
