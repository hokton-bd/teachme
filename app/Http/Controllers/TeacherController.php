<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Lectures;
use App\Common\UserClass;
use App\Common\SessionClass;

class TeacherController extends Controller
{
    
    public function store($user_id, $grade, $subject) {

        $teacher = new Teacher;
        $teacher->user_id = $user_id;
        $teacher->grade = $grade;
        $teacher->subject_id = $subject;

        $teacher->save();

    }



    public function register(RegisterRequest $req) {

        $validated = $req->validated();
        $user_id = UserClass::store($req);
        $user = User::find($user_id);
        $user->role = 9;
        $user->save();
        $this->store($user_id, $req->grade, $req->subject);
        $teacher_id = User::find($user->id)->teacher()->value('id');
        session(['user_id' => $user->id, 'role' => $user->role, 'teacher_id' => $teacher_id]);

        return redirect()->route('teacher.dashboard');
        
    }

    public function getComingLectures() {

        $user_id = session('user_id');
        $teacher_id = User::find($user_id)->teacher()->value('id');

        return $coming_lectures = Teacher::find($teacher_id)->lectures()
                                        ->where('date', '>=', date('Y-m-d'))
                                        ->where('student_id', '!=', 'null')
                                        ->orderBy('date', 'ASC')
                                        ->get();

    }

    public function displayDashboard() {

        $coming_lectures = $this->getComingLectures();

        $user = User::find(session('user_id'));
        return view('teacher.dashboard', compact('coming_lectures', 'user'));

    }

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
