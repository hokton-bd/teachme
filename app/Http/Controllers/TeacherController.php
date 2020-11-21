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
        $this->store($user_id, $req->grade, $req->subject);
        SessionClass::store($user_id);

        return redirect()->route('home');
        
    }


}
