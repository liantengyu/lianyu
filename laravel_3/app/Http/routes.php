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

Route::get('login', function () {
    return view('user/login');
});

Route::get('plan/add', 'PlanController@add');
Route::any('plan/create', 'PlanController@create');
Route::any('planremind/create', 'PlanRemindController@create');

Route::any('login_check', 'UserController@login_check');

