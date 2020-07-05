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
Route::prefix('v1')->namespace('api\v1')->group(function (){
    Route::get('/courses', 'CourseController@index');
    Route::post('/courses', 'CourseController@store');
    Route::get('/courses/{course}', 'CourseController@single');

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    Route::middleware('auth:api')->group(function (){
        // har route dar inja bashad niyaz be auth darad
        Route::get('/user', function () {
            return Auth()->user();
        });
        Route::post('comment', 'CommentController@store');
        Route::post('upload/image', 'UploadController@image');
        Route::post('upload/file', 'UploadController@file');
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
