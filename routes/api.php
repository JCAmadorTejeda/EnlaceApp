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
Route::resource('users', 'User\UserController');

Route::resource('requeststatus', 'Request\RequestStatusController', ['only' => ['index', 'show']]);

Route::resource('requests', 'Request\RequestController', ['only' => ['index', 'show']]);