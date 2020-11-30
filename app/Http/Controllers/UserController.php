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
            session(['role' => $user->role, 'name' => $user->name]);
            
            if($user->role == 9) {

                session(['teacher_id' => User::find($user->id)->teacher()->value('id')]);
                return redirect('teacher/dashboard');
                // echo 'success';

            } else if($user->role == 10) {

                session(['teacher_id' => User::find($user->id)->student()->value('id')]);
                return redirect('student/dashboard');

            } else {
                echo 'failed';
            }

        } else {//enter wrong email or password
            
            $message = 'メールアドレスもしくはパスワードが間違っています';
            
            return redirect('/')->with('message');

        }

    }

    public function logout() {

        session()->flush();

        return redirect('/');

    }


}
