<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Common\UserClass;
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

        return redirect()->route('home');
        
    }


}
