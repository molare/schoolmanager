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
Route::middleware(['auth'])->group(function () {   

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

Route::get('/paymentType', function () {
    return view('paymentType');
})->name('paymentType');

Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::get('/sitting', function () {
    return view('sitting');
})->name('sitting');

Route::get('/getSchoolYearActive','SchoolYearController@getSchoolYearActive');
Route::get('/countClasse','ClassRoomController@countClasse');
Route::get('/countStudent','StudentController@countStudent');
Route::get('/dashbordStudent','StudentController@dashbordStudent');
Route::get('/getStudentByClasse/{id}','StudentController@getStudentByClasse');
Route::get('/getStudentByYear','StudentController@getStudentByYear');
Route::get('/countCourse','CourseController@countCourse');
Route::get('/countTeacher','TeacherController@countTeacher');
Route::resource('categories','CategoryController');
Route::resource('genres','GenreController');
Route::resource('schoolYears','SchoolYearController');
Route::resource('classRooms','ClassRoomController');
Route::resource('courses','CourseController');
Route::resource('teachers','TeacherController');
Route::resource('parents','ParentController');
Route::resource('students','StudentController');
Route::resource('paymentTypes','PaymentTypeController');
Route::resource('payments','PaymentController');
Route::resource('sittings','SittingController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', 'Auth/LoginController@logout');
});
Auth::routes();
