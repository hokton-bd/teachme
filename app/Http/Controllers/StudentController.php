<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Common\UserClass;
use App\Common\SessionClass;
use App\Common\LectureClass;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    
    public function store($user_id, $grade) {

        $student = new Student;
        $student->user_id = $user_id;
        $student->grade = $grade;

        $student->save();

    }

    public function register(RegisterRequest $req) {

        $validated = $req->validated();
        $user_id = UserClass::store($req);
        $this->store($user_id, $req->grade);
        $user = User::find($user_id);

        session(['user_id' => $user->id, 'role' => $user->role, 'student_id' => User::find($user->id)->student()->value('id')]);

        return redirect()->route('home');
        
    }

    public function displayDashboard() {

        $lectures = $this->getComingLectures();

        $names = [];

        for($i = 0; $i < $lectures->count(); $i++) {

            $teacher_name = LectureClass::getTeacherName($lectures[$i]->teacher_id);
            $subject_name = LectureClass::getSubjectName($lectures[$i]->subject_id);

            $array = ['teacher_name' => $teacher_name, 'subject_name' => $subject_name];

            $names[$i] = $array;

        }
        
        $user = User::find(session('user_id'));
        
        return view('student.dashboard', compact('lectures', 'user', 'names'));

    }

    public function getComingLectures() {

        $user_id = session('user_id');
        $student_id = User::find($user_id)->student()->value('id');
        $coming_lectures = Student::find($student_id)->lectures()->where('date', '>=', date('Y-m-d'))->orderBy('date', 'ASC')->get();
        
        return $coming_lectures;

    }


}
