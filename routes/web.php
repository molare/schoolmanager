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
})->name("home");

Route::get('/category', function () {
    return view('category');
})->name('category');

Route::get('/gender', function () {
    return view('civility');
})->name('gender');

Route::get('/schoolyear', function () {
    return view('year');
})->name('schoolyear');

Route::get('/classRoom', function () {
    return view('classRoom');
})->name('classRoom');

Route::get('/course', function () {
    return view('course');
})->name('course');

Route::get('/teacher', function () {
    return view('teacher');
})->name('teacher');

Route::get('/parent', function () {
    return view('parent');
})->name('parent');

Route::get('/student', function () {
    return view('student');
})->name('student');

Route::get('/getSchoolYearActive', 
'SchoolYearController@getSchoolYearActive');
Route::resource('categories','CategoryController');
Route::resource('genres','GenreController');
Route::resource('schoolYears','SchoolYearController');
Route::resource('classRooms','ClassRoomController');
Route::resource('courses','CourseController');
Route::resource('teachers','TeacherController');
Route::resource('parents','ParentController');
Route::resource('students','StudentController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
