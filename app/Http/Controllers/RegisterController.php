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

    public function storeUser($req) {

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);

        $user->save();

        return $user->id;

    }

    public function registerStudent(RegisterRequest $req) {

        $validated = $req->validated();
        $user_id = $this->storeUser($req);
        $this->storeStudent($user_id, $req->grade);

        return redirect()->route('home');
        
    }

    public function registerTeacher(RegisterRequest $req) {

        $validated = $req->validated();
        $user_id = $this->storeUser($req);
        $user = User::find($user_id);
        $user->role = 9;
        $this->storeStudent($user_id, $req->grade);

        return redirect()->route('home');
        
    }


}
