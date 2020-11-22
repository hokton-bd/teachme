<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Common\SessionClass;
use App\Common\UserClass;

class UserController extends Controller
{
    
    public function login(Request $req) {

        $credentials = $req->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            $user = User::where('email', '=', $req->email)->first();
            SessionClass::store($user->id);
            
            if($user->role == 9) {

                return redirect('teacher/dashboard');
                // echo 'success';

            } else if($user->role == 10) {

                // return redirect()->route('student.dashboard');

            } else {



            }

        }

    }


}
