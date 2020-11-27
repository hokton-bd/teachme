<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Teacher;
use App\Models\User;
use App\Common\UserClass;
use App\Common\SessionClass;

class TeacherController extends Controller
{
    
    public function store($user_id, $grade, $subject) {

        $teacher = new Teacher;
        $teacher->user_id = $user_id;
        $teacher->grade = $grade;
        $teacher->subject_id = $subject;

        $teacher->save();

    }



    public function register(RegisterRequest $req) {

        $validated = $req->validated();
        $user_id = UserClass::store($req);
        $user = User::find($user_id);
        $user->role = 9;
        $user->save();
        $this->store($user_id, $req->grade, $req->subject);
        $teacher_id = User::find($user->id)->teacher()->value('id');
        session(['user_id' => $user->id, 'role' => $user->role, 'teacher_id' => $teacher_id]);

        return redirect()->route('teacher.dashboard');
        
    }

    public function getComingLectures() {

        $user_id = session('user_id');
        $teacher_id = User::find($user_id)->teacher()->value('id');

        return $coming_lectures = Teacher::find($teacher_id)->lectures()
                                        ->where('date', '>=', date('Y-m-d'))
                                        ->where('student_id', '!=', 'null')
                                        ->orderBy('date', 'ASC')
                                        ->get();

    }

    public function displayDashboard() {

        $coming_lectures = $this->getComingLectures();

        $user = User::find(session('user_id'));
        return view('teacher.dashboard', compact('coming_lectures', 'user'));

    }


}
