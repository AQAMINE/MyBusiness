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
// Start Notification Routes
Route::post('clear/notifications','NotificationControler@removeAll')->name('clearNotifications');
// End Notification Routes

//Start Users Route
Route::post('/User/find', 'UserController@findUser')->name('find.user');
Route::post('EditProfilePicture/', 'UserController@ChangeProfilePic')->name('EditProfilePicture');
Route::post('UpdateUser', 'UserController@UpdateUser')->name('UpdateUser');
Route::get('/myprofile/{id}' , 'UserController@show')->name('showProfile');
Route::get('/myprofile/update/{id}','UserController@edit')->name('editeProfile');
Route::delete('myprofile/{id}','UserController@RemoveAccount')->name('close.account');
//End Users Route

//Start Clients Routes
Route::post('client/edit', 'ClientController@EditClient')->name('EditTask');
Route::post('client/find/', 'ClientController@FindClient')->name('FindClient');
//End Clients Routes

//Start Tasks Routes
Route::get('tasks', 'TaskController@index');
Route::get('tasks/{id}', 'TaskController@taskDone')->name('TaskDone');
Route::get('task/{id}', 'TaskController@taskUndone')->name('TaskUndone');
Route::post('task/edit', 'TaskController@EditTask')->name('UpdateTask');
//End Tasks Routes

// Start LocalAds Routes
Route::get('loacl/ad/hide/show/{id}' , 'LocalAdsController@hideShowLocalAd')->name('HideShowLocalAd');
// End LocalAds Routes

//Start Resource  Controller
Route::resource('/LocalAds', 'LocalAdsController');
Route::resource('/client', 'ClientController');
Route::resource('/tasks', 'TaskController');
Route::resource('/notifications', 'NotificationControler');
Route::resource('/user', 'UserController');
//End  Resource Controller

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
