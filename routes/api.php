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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['apiJwt']], function () {
    
    // USER ROUTES
    Route::get('users', 'Api\UserController@index');
    Route::get('users/{id}', 'Api\UserController@show');

    // POST ROUTES
    Route::get('posts', 'Api\PostController@index');
    Route::post('posts', 'Api\PostController@store');
    Route::get('posts/{id}', 'Api\PostController@show');
});


Route::post('auth/login', 'Api\AuthController@login');
// Route::post('logout', 'AuthController@logout');
// Route::post('refresh', 'AuthController@refresh');
// Route::post('me', 'AuthController@me');
