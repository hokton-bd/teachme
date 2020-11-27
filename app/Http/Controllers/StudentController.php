<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Common\UserClass;
use App\Common\SessionClass;
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

        SessionClass::store($user_id);

        return redirect()->route('home');
        
    }

    public function displayDashboard() {

        $coming_lectures = $this->getComingLectures();
        $user = User::find(session('user_id'));
        
        return view('student.dashboard', compact('coming_lectures', 'user'));

    }

    public function getComingLectures() {

        $user_id = session('user_id');
        $student_id = User::find($user_id)->student()->value('id');
        $coming_lectures = Student::find($student_id)->lectures()->where('date', '>=', date('Y-m-d'))->get();
        
        return $coming_lectures;

    }


}
