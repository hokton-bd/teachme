<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('signup', 'SubjectController@show');

Route::post('signup.student', 'StudentController@register');

Route::post('signup.teacher', 'Teacher\TeacherController@register');

Route::get('teacher/dashboard', 'Teacher\TeacherController@displayDashboard')->name('teacher.dashboard');

Route::get('student/dashboard', 'StudentController@displayDashboard')->name('student.dashboard');

Route::post('login', 'UserController@login')->name('login');

Route::get('logout', 'UserController@logout')->name('logout');

Route::get('teacher/schedule', 'Teacher\LectureController@viewSchedule')->name('teacher.schedule');

Route::post('teacher/schedule', 'Teacher\LectureController@add_shift')->name('add_shift');

Route::get('student/reserve', 'Student\LecturesController@getAvailableLectures')->name('student.reserve');

Route::get('student/reserve/paycheck/{id}', 'Student\LecturesController@paycheck')->name('student.paycheck');

Route::post('student/reserve/charge/{id}', 'Student\LecturesController@reserve')->name('student.charge');

Route::get('student/reserve/{subjectId?}', 'Student\LecturesController@getLecturesBySubjectId');

Route::get('privacy-policy', function() {
    return view('privacy-policy');
});

Route::get('terms-of-service', function() {
    return view('terms-of-service');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');