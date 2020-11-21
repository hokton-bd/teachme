<?php

namespace App\Common;

use Illuminate\Http\Request;
use App\Models\User;

class SessionClass
{
    
    public static function store($user_id) {

        session(['user_id' => $user_id]);

    }


}
