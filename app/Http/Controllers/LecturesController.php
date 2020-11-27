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
    public function add_shift(Request $req) {

        $date = $req->date;
        $start_time = $req->start_time.':00';
        $end_time = $start_time.'40';

        $lectures = new Lectures();
        $teacher = User::find(session('user_id'))->teacher();

        $lectures->date = $date;
        $lectures->start_time = $start_time;
        $lectures->end_time = $end_time;
        $lectures->teacher_id = $teacher->value('id');
        $lectures->subject_id = $teacher->value('subject_id');
        $lectures->save();

        $message = '追加されました';

        $shifts = Lectures::where('teacher_id', '=', session('teacher_id'))
                            ->where('date', '>=', date('Y-m-d'))
                            ->orderBy('date', 'ASC')
                            ->get();

        return view('teacher.schedule', compact('message', 'shifts'));

    }

    public function getSchedule() {

        $shifts = Lectures::where('teacher_id', '=', session('teacher_id'))
                            ->where('date', '>=', date('Y-m-d'))
                            ->orderBy('date', 'ASC')
                            ->get();

        return view('teacher.schedule', compact('shifts'));

    }


}
