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

Route::get('teacher/dashboard', 'LecturesController@getTeacherComingLectures')->name('teacher.dashboard');

Route::post('login', 'UserController@login')->name('login');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
