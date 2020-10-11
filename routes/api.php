<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', 'Api\Auth\AuthController@register');
    Route::post('/login', 'Api\Auth\AuthController@login');
    Route::post('/logout', 'Api\Auth\AuthController@logout')
        ->middleware('auth:sanctum');

    Route::post('/password/reset', 'Api\Auth\PasswordController@reset')
        ->middleware('auth:sanctum');
    Route::post('/password/forgot', 'Api\Auth\PasswordController@sendResetLinkEmail');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('attendance', 'Api\AttendanceController@store');
    Route::get('attendance/history', 'Api\AttendanceController@history');
});
