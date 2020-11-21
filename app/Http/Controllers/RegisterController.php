<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Common\UserClass;

class RegisterController extends Controller
{
    public function storeStudent($user_id, $grade) {

        $student = new Student;
        $student->user_id = $user_id;
        $student->grade = $grade;

        $student->save();

    }

    public function storeTeacher($user_id, $grade, $subject) {

        $teacher = new Teacher;
        $teacher->user_id = $user_id;
        $teacher->grade = $grade;
        $teacher->subject_id = $subject;

        $teacher->save();

    }


    public function registerStudent(RegisterRequest $req) {

        $validated = $req->validated();
        $user_id = UserClass::store($req);
        $this->storeStudent($user_id, $req->grade);

        return redirect()->route('home');
        
    }

    public function registerTeacher(RegisterRequest $req) {

        $validated = $req->validated();
        $user_id = $this->storeUser($req);
        $user = User::find($user_id);
        $user->role = 9;
        $this->storeTeacher($user_id, $req->grade, $req->subject);

        return redirect()->route('home');
        
    }


}
