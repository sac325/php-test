<?php

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
    return view('welcome');
});




Route::group(['middleware' => ['jwt.verify']], function() {


    //courses 
    Route::post('/courses', 'CourseController@store');
    Route::get('/courses', 'CourseController@getCoursePaginated');
    Route::get('/courses/all', 'CourseController@getAll');
    Route::get('/courses/{id}', 'CourseController@show');
    
    Route::put('/courses/{id}', 'CourseController@update');
    Route::delete('/courses/{id}', 'CourseController@destroy');

    //students 
    Route::post('/students', 'StudentController@store');
    Route::get('/students', 'StudentController@getStudentPaginated');
    Route::get('/students/all', 'StudentController@getAll');
    Route::get('/students/{id}', 'StudentController@show');
    
    Route::put('/students/{id}', 'StudentController@update');
    Route::delete('/students/{id}', 'StudentController@destroy');

});

Route::get('token', 'UserController@getToken');