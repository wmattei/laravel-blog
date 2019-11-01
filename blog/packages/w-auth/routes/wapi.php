<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Garante tentativas maximas de 5
 */
Route::middleware('throttle:10,1')->prefix('auth')->group(function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/forgot-password', 'AuthController@sendResetLinkEmail');
    // Route::post('/logout', 'Auth\LoginController@logout');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::group(['prefix' => 'category'], function () {
        Route::post('', 'CategoryController@store');
    });
});


//Home
Route::get('/home', 'HomeController@index');
