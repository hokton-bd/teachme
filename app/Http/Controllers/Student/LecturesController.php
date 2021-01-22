<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Common\LectureClass;
use App\Models\Lectures;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;

class LecturesController extends Controller
{

    public function getLecturesBySubjectId($subjectId) {

        $av_lectures = Lectures::where('date', '>=', date('Y-m-d'))
                               ->where('status', 0)
                               ->where('subject_id', '=', $subjectId)
                               ->orderBy('date', 'ASC')
                               ->orderBy('start_time', 'ASC')
                               ->get();

        if($av_lectures->count() > 0) {
           
            for($i = 0; $i < $av_lectures->count(); $i ++) {

                $teacher_name = LectureClass::getTeacherName($av_lectures[$i]->teacher_id);
                $subject_name = LectureClass::getSubjectName($av_lectures[$i]->subject_id);

                $data[$i]['teacher_name'] = $teacher_name;
                $data[$i]['subject_name'] = $subject_name;
                $data[$i]['meta'] = $av_lectures[$i];

            }

        } else {

            $data = [];

        }
        
        return response()->json($data);

    }
    
    public function getAvailableLectures() {

        $av_lectures = Lectures::where('date', '>=', date('Y-m-d'))
                               ->where('status', 0)
                               ->orderBy('date', 'ASC')
                               ->orderBy('start_time', 'ASC')
                               ->get();

        $names = [];
           
        for($i = 0; $i < $av_lectures->count(); $i ++) {
                
            $teacher_name = LectureClass::getTeacherName($av_lectures[$i]->teacher_id);
            $subject_name = LectureClass::getSubjectName($av_lectures[$i]->subject_id);

            $tmp2 = ['teacher_name' => $teacher_name, 'subject_name' => $subject_name];

            $names[$i] = $tmp2;
        }

        $subjects = LectureClass::getSubjects();

        return view('student.reserve', compact('av_lectures', 'names', 'subjects'));

    }

    public function paycheck($id) {

        $lecture = Lectures::find($id);

        $teacher_name = LectureClass::getTeacherName($lecture->teacher_id);
        $subject_name = LectureClass::getSubjectName($lecture->subject_id);

        return view('student.paycheck', compact('lecture', 'teacher_name', 'subject_name'));

    }

    public function reserve($id) {

        $lecture = Lectures::find($id);

        $lecture->status = 1;
        $lecture->student_id = User::find(session('user_id'))->student()->value('id');
        $lecture->updated_at = time();

        $lecture->save();

        $message = '授業が予約されました';

        return redirect('student/reserve')->with('message', $message);

    }


}
