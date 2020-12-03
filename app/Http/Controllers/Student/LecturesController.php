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

    public function paycheck($id) {

        $lecture = Lectures::find($id);

        $teacher_name = $this->getTeacherName($lecture->teacher_id);
        $subject_name = $this->getSubjectName($lecture->subject_id);

        return view('student.paycheck', compact('lecture', 'teacher_name', 'subject_name'));

    }

    public function reserve($id) {

        $lecture = Lectures::find($id);

        $lecture->status = 1;
        $lecture->student_id = User::find(session('user_id'))->student()->value('id');
        $lecture->updated_at = time();

        $lecture->save();

        $message = 'success';

        session()->flash($message);

        return redirect('student/reserve');

    }


}
