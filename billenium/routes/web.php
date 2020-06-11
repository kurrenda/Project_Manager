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
    Route::get('/raports', 'RaportsController@index')->name('raports');
});


Route::group(['middleware' => ['auth','role:Team Leader|Admin' ]], function () {
    Route::get('/task/add', 'AddTaskController@index')->name('addTaskForm');
    Route::post('/task/add', 'AddTaskController@addTask')->name('addTaskPost');

    Route::get('/project/add', 'AddProjectController@index')->name('addProjectForm');
    Route::post('/project/add', 'AddProjectController@addProject')->name('addProjectPost');
    Route::post('/project/close', 'TimerRegisterController@closeProject')->name('closeProject');
    Route::get('/raport/accept', 'AcceptController@index')->name('accept');
    Route::post('/raport/accept', 'AcceptController@accept')->name('acceptPost');
    Route::post('/raport/accept/delete', 'AcceptController@delete')->name('acceptDelete');
});


Route::group(['middleware' => ['auth','role:Admin' ]], function () {
    Route::get('/user/add', 'AddUserController@index')->name('addUserForm');
    Route::post('/user/add', 'AddUserController@addTask')->name('addUserPost');

    Route::get('/users/edit', 'EditAuthController@index')->name('editAuth');
    Route::post('/users/delete', 'EditAuthController@deleteUser')->name('editAuthDelete');
    Route::get('/users/edit/{id}', 'EditAuthController@indexAuth')->name('editAuthUser');
    Route::post('/users/edit/{id}', 'EditAuthController@editAuth')->name('editAuthPost');

});




Auth::routes();

