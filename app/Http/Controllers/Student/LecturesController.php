<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lectures;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;

class LecturesController extends Controller
{
    
    public function getAvailableLectures() {

        $av_lectures = Lectures::where('date', '>=', date('Y-m-d'))
                               ->where('status', 0)
                               ->orderBy('date', 'ASC')
                               ->orderBy('start_time', 'ASC')
                               ->get();

        $names = [];
           
        for($i = 0; $i < $av_lectures->count(); $i ++) {
                
            $teacher_name = $this->getTeacherName($av_lectures[$i]->teacher_id);
            $subject_name = $this->getSubjectName($av_lectures[$i]->subject_id);

            $tmp2 = ['teacher_name' => $teacher_name, 'subject_name' => $subject_name];

            $names[$i] = $tmp2;    
            
        }


        return view('student.reserve', compact('av_lectures', 'names'));

    }


    public function getTeacherName($teacher_id) {

        $name = Teacher::find($teacher_id)->user()->value('name');

        return $name;

    }

    public function getSubjectName($subject_id) {

        $subject = Subject::find($subject_id);

        return $subject->subject_name;

    }


}
