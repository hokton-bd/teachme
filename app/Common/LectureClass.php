<?php

namespace App\Common;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;

class LectureClass
{
    
    public static function getTeacherName($teacher_id) {

        $name = Teacher::find($teacher_id)->user()->value('name');

        return $name;

    }

    public static function getSubjectName($subject_id) {

        $subject = Subject::find($subject_id);

        return $subject->subject_name;

    }

}
