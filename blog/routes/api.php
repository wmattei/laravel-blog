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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Garante tentativas maximas de 5
 */
Route::middleware('throttle:2,1')->group(function () {
    // Route::post('/register', 'Auth\RegisterController@create'); // TODO reduzir o caminho
    // Route::post('/login', 'Auth\LoginController@login');
    // Route::post('/logout', 'Auth\LoginController@logout');
});

//Home
// Route::get('/home', 'HomeController@index');
