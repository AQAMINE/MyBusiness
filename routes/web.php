<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

//Start Clients Routes
Route::post('client/edit' , 'ClientController@EditClient')->name('EditTask');
Route::post('client/find/' , 'ClientController@FindClient')->name('FindClient');
//End Clients Routes

//Start Tasks Routes
Route::get('tasks' , 'TaskController@index');
Route::get('tasks/{id}' , 'TaskController@taskDone')->name('TaskDone');
Route::get('task/{id}' ,'TaskController@taskUndone')->name('TaskUndone');
Route::post('task/edit' , 'TaskController@EditTask')->name('UpdateTask');
//End Tasks Routes

//Start Resource  Controller
Route::resource('/client','ClientController');
Route::resource('/tasks', 'TaskController');
Route::resource('/notifications', 'NotificationControler');
//End  Resource Controller

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
