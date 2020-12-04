<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lectures;
use App\Models\Teacher;
use App\Models\User;

class LectureController extends TeacherController
{

    public function add_shift(Request $req) {

        $date = $req->date;
        $start_time = $req->start_time.':00';
        $end_time = $start_time.'40';

        if($this->isOver($date, $start_time)) { //does not over

            $lectures = new Lectures();
            $teacher = User::find(session('user_id'))->teacher();

            $lectures->date = $date;
            $lectures->start_time = $start_time;
            $lectures->end_time = $end_time;
            $lectures->teacher_id = $teacher->value('id');
            $lectures->subject_id = $teacher->value('subject_id');
            $lectures->save();

            $message = '追加されました';

            $shifts = $this->getSchedule();

            return view('teacher.schedule', compact('message', 'shifts'));

        } else { //there is a over lecture

            $message = 'その時間はすでに登録されています';
            $shifts = $this->getSchedule();
            return view('teacher.schedule', compact('message', 'shifts'));

        }

    }

    public function isOver($date, $start_time) {

        return Lectures::where('date', '=', $date)
                        ->where('start_time', '=', $start_time)
                        ->where('teacher_id', '=', session('teacher_id'))
                        ->doesntExist();

    }

    public function getSchedule() {

        $shifts = Lectures::where('teacher_id', '=', session('teacher_id'))
                            ->where('date', '>=', date('Y-m-d'))
                            ->where('status', 0)
                            ->orderBy('date', 'ASC')
                            ->orderBy('start_time', 'ASC')
                            ->get();

        return $shifts;

    }

    public function viewSchedule() {
        
        $shifts = $this->getSchedule();

        return view('teacher.schedule', compact('shifts'));

    }



}
