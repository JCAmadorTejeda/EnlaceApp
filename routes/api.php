<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
* Users
*/
Route::resource('users', 'User\UserController');
Route::resource('users.requests', 'User\UserRequestController', ['only' => 'index']);
/**
* RequestStatus
*/
Route::resource('requeststatus', 'Request\RequestStatusController');

/**
* Request
*/
Route::resource('requests', 'Request\RequestcController');

