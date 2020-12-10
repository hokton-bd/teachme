<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Lectures;
use App\Models\Teacher_subject_teachable;
use App\Common\UserClass;
use App\Common\SessionClass;
use App\Common\LectureClass;

class TeacherController extends Controller
{
    
    public function store($user_id, $grade) {

        $teacher = new Teacher;
        $teacher->user_id = $user_id;
        $teacher->grade = $grade;

        $teacher->save();

    }

    public function storeTeachable($teacher_id, $subjects) {

        foreach($subjects as $subject) {
            
            $teachable = new Teacher_subject_teachable;
            $teachable->teacher_id = $teacher_id;
            $teachable->subject_id = $subject;
            $teachable->save();

        }

    }



    public function register(RegisterRequest $req) {

        $validated = $req->validated();
        $user_id = UserClass::store($req);
        $user = User::find($user_id);
        $user->role = 9;
        $user->save();
        $this->store($user_id, $req->grade);
        $teacher_id = User::find($user->id)->teacher()->value('id');


        $this->storeTeachable($teacher_id, $req->subjects);

        session(['user_id' => $user->id, 'role' => $user->role, 'teacher_id' => $teacher_id, 'name' => $user->name]);

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

        $names = [];
        
        for($i = 0; $i < $coming_lectures->count(); $i ++) {
            
            $names[$i] = LectureClass::getStudentName($coming_lectures[$i]->student_id);

        }

        $user = User::find(session('user_id'));
        return view('teacher.dashboard', compact('coming_lectures', 'user', 'names'));

    }


}
