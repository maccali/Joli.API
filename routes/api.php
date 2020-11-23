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

Route::group(['middleware' => ['audit', 'apiJwt']], function () {

  // USER ROUTES
  Route::get('users', 'Api\UserController@index');
  Route::post('user', 'Api\UserController@store');
  Route::get('users/{id}', 'Api\UserController@show');
  Route::put('user/{nome}', 'Api\UserController@update');
  Route::delete('users/{nome}', 'Api\UserController@delete');

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

  // AUDITORIA
  Route::get('auditoria', 'Api\AuditHistoriesController@index');

  // DASHBOARD
  Route::get('totalizador/requisicoes', 'Api\DashboardController@countAudit');
  Route::get('totalizador/processos', 'Api\DashboardController@countProcessos');
  Route::get('totalizador/usuarios', 'Api\DashboardController@countUsuarios');

  // PESSOAS / CLIENTES
  Route::get('pessoas', 'Api\PessoaController@index');
  Route::post('pessoa', 'Api\PessoaController@store');
  Route::get('pessoa/{id}', 'Api\PessoaController@show');
  Route::get('pessoa/{nome}', 'Api\PessoaController@showName');
  Route::put('pessoa/{id}', 'Api\PessoaController@update');
  Route::delete('pessoa/{id}', 'Api\PessoaController@destroy');
  // Route::post('pessoa/fisica/cliente', 'Api\PessoaController@storeFisicaCliente');
  // Route::post('pessoa/juridica/cliente', 'Api\PessoaController@storeJuridicaCliente');
  // Route::post('pessoa/fisica/funcionario', 'Api\PessoaController@storeFisicaFuncionario');
  // Route::put('pessoa/fisica/cliente/{id}', 'Api\PessoaController@updateFisicaCliente');
  // Route::put('pessoa/juridica/cliente/{id}', 'Api\PessoaController@updateJuridicaCliente');
  // Route::put('pessoa/fisica/funcionario/{id}', 'Api\PessoaController@updateFisicaFuncionario');
  // Route::delete('pessoa/fisica/cliente/{id}', 'Api\PessoaController@destroyFisicaCliente');
  // Route::delete('pessoa/juridica/cliente/{id}', 'Api\PessoaController@destroyJuridicaCliente');
  // Route::delete('pessoa/fisica/funcionario/{id}', 'Api\PessoaController@destroyFisicaFuncionario');
});

Route::group(['middleware' => ['audit']], function () {
  Route::post('auth/login', 'Api\AuthController@login');
});
