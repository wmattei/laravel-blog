<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Garante tentativas maximas de 5
 */
Route::middleware('throttle:20,1')->group(function () {
    // Route::post('/register', 'Auth\RegisterController@create'); // TODO reduzir o caminho
    Route::post('/login', 'AuthController@login');
    // Route::post('/logout', 'Auth\LoginController@logout');
});

//Home
Route::get('/home', 'HomeController@index');
