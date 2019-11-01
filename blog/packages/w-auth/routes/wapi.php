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
    Route::post('/login', 'Http\Controllers\AuthController@login');
    Route::post('/register', 'Http\Controllers\AuthController@register');
    Route::post('/forgot-password', 'Http\Controllers\AuthController@sendResetLinkEmail');
    // Route::post('/logout', 'Auth\LoginController@logout');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::group(['prefix' => 'category', 'namespace' => 'Domain'], function () {
        Route::post('', 'Category\Http\Controller\CategoryController@store');
    });
});


//Home
Route::get('/home', 'HomeController@index');
