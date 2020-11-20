<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;

class RegisterController extends Controller
{
    public function validate($req) {

        $validationData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        return $validationData;

    }
    
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

    public function registerStudent(Request $req) {

        $this->validate($req);

        $user_id = $this->createUser($req);
        $this->storeStudent($user_id, $req->grade);

        return redirect()->route('home');
        
    }


}
