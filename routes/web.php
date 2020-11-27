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

Route::post('signup.teacher', 'TeacherController@register');

Route::get('teacher/dashboard', 'TeacherController@displayDashboard')->name('teacher.dashboard');

Route::get('student/dashboard', 'StudentController@displayDashboard')->name('student.dashboard');

Route::post('login', 'UserController@login')->name('login');

Route::get('logout', 'UserController@logout')->name('logout');

Route::get('teacher/schedule', 'LecturesController@getSchedule')->name('teacher.schedule');

Route::post('teacher/schedule', 'LecturesController@add_shift')->name('add_shift');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
