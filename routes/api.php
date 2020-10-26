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

Route::group(['middleware' => ['audit', 'apiJwt']], function () {

    // USER ROUTES
    Route::get('users', 'Api\UserController@index');
    Route::get('users/{id}', 'Api\UserController@show');

    // POST ROUTES
    Route::get('posts', 'Api\PostController@index');
    Route::post('posts', 'Api\PostController@store');
    Route::get('posts/{id}', 'Api\PostController@show');

        // SOCIEDADE ROUTES
    Route::get('sociedades', 'Api\SociedadeController@index');
    Route::post('sociedade', 'Api\SociedadeController@store');
    Route::get('sociedade/{nome}', 'Api\SociedadeController@show');
    Route::put('sociedade/{nome}', 'Api\SociedadeController@update');
    Route::delete('sociedades/{nome}', 'Api\SociedadeController@delete');

    // COSTUMES ROUTES
    Route::get('costumes', 'Api\CostumeController@index');
    Route::post('costume', 'Api\CostumeController@store');
    Route::get('costume/{nome}', 'Api\CostumeController@show');
    Route::put('costume/{nome}', 'Api\CostumeController@update');
    Route::delete('costumes/{nome}', 'Api\CostumeController@delete');
});

Route::group(['middleware' => ['audit']], function () {
  Route::post('auth/login', 'Api\AuthController@login');
});
// Route::post('logout', 'AuthController@logout');
// Route::post('refresh', 'AuthController@refresh');
// Route::post('me', 'AuthController@me');
