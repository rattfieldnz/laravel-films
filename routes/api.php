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

header('Access-Control-Allow-Origin: ' . env('APP_URL'));
header('Access-Control-Allow-Credentials: true');

Route::group(['prefix' => 'v1', 'namespace' => 'API'], function () {
    Route::resource('films', 'FilmAPIController');

    Route::resource('genres', 'GenreAPIController');

    Route::resource('comments', 'CommentAPIController');
});