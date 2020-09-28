<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','TeacherController@welcome');

Route::get('/teacher','TeacherController@index');
Route::get('/teacher/all','TeacherController@allData');
Route::post('/teacher/add','TeacherController@addData');

Route::get('/student','StudentController@index');
Route::post('/student/add','StudentController@addData');
Route::get('/student/all','StudentController@allData');
Route::get('/student/edit/{id}','StudentController@editData');
Route::put('/student/update','StudentController@updateData');
Route::delete('/student/destroy/{id}','StudentController@destroyData');

















