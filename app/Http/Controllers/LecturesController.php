<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\SessionClass;
use App\Models\Lectures;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\User;

class LecturesController extends Controller
{
    
    public function getTeacherComingLectures() {

        $user_id = session('user_id');
        

    }


}
