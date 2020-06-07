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



Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', 'TaskLogsController@index')->name('tasks');
    Route::post('/task/time/add', 'TaskLogsController@registerTime')->name('addTime');
    Route::get('/task/stats', 'TimerRegisterController@index')->name('stats');
});


Route::group(['middleware' => ['auth','role:Team Leader']], function () {
    Route::get('/task/add', 'AddTaskController@index')->name('addTaskForm');
    Route::post('/task/add', 'AddTaskController@addTask')->name('addTaskPost');
    Route::get('/user/add', 'AddUserController@index')->name('addUserForm');
    Route::post('/user/add', 'AddUserController@addTask')->name('addUserPost');

});



Auth::routes();

