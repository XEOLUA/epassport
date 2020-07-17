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

use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@index')->name('index');
Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');
Route::get('/profile', 'ProfileController@show')->name('profile');
Route::get('/students', 'StudentsController@show')->name('students');
Route::get('/students/abetka/{alpha}', 'StudentsController@abetka')->name('abetka');
Route::get('/students/years/{year}', 'StudentsController@years')->name('years');
Route::get('/students/groups/{group}', 'StudentsController@groups')->name('groups');
Route::get('/cabinet/amb/{student_id}', 'StudentsController@ambulat')->name('ambulat');
Route::get('/cabinet/anamn/{student_id}', 'StudentsController@anamn')->name('anamn');
Route::get('/cabinet/listads/{student_id}', 'StudentsController@listads')->name('listads');
Route::get('/cabinet/listpsihtest/{student_id}', 'StudentsController@listpsihtest')->name('listpsihtest');
Route::get('/cabinet/listanketa/{student_id}', 'StudentsController@listanketa')->name('listpanketa');
Route::get('/cabinet/{id}', 'StudentsController@cabinet')->name('cabinet');
Route::get('/cabinet/resultsspets/{student_id}', 'StudentsController@resultsspets')->name('resultsspets');
Route::get('/test/results/{test_id}/{user_id}', 'TestController@show')->name('testshow');
Route::get('/test/run/{test_id}', 'TestController@run')->name('testrun');
Route::post('/test/save/{test_id}', 'TestController@save')->name('testsave');
Route::post('/profile', 'ProfileController@edit')->name('editprofile');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/login', function () {
//    return view('home');
//});


