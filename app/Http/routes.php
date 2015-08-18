<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'client'], function() {
    Route::get('/', 'ClientController@index');
    Route::post('/', 'ClientController@store');
    Route::get('/{id}', 'ClientController@show');
    Route::delete('/{id}', 'ClientController@destroy');
    Route::put('/{id}', 'ClientController@update');
});

Route::group(['prefix' => 'project'], function() {
    Route::get('/', 'ProjectController@index');
    Route::post('/', 'ProjectController@store');
    Route::get('/{id}', 'ProjectController@show');
    Route::delete('/{id}', 'ProjectController@destroy');
    Route::put('/{id}', 'ProjectController@update');
});

Route::group(['prefix' => 'project/{id}/note'], function() {
    Route::get('/', 'ProjectNoteController@index');
    Route::post('/', 'ProjectNoteController@store');
    Route::get('/{noteId}', 'ProjectNoteController@show');
    Route::put('/{noteId}', 'ProjectNoteController@update');
    Route::delete('/{noteId}', 'ProjectNoteController@destroy');
});

Route::group(['prefix' => 'project/{id}/task'], function() {
    Route::get('/', 'ProjectTaskController@index');
    Route::post('/', 'ProjectTaskController@store');
    Route::get('/{taskId}', 'ProjectTaskController@show');
    Route::put('/{taskId}', 'ProjectTaskController@update');
    Route::delete('/{taskId}', 'ProjectTaskController@destroy');
});

Route::group(['prefix' => 'project/{id}/members'], function() {
    Route::get('/', 'ProjectMemberController@index');
    Route::post('/', 'ProjectMemberController@store');
    Route::delete('/{memberId}', 'ProjectMemberController@destroy');
    Route::get('/{memberId}/ismember', 'ProjectMemberController@check');
});