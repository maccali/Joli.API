<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//GET ROUTES FOR CONTROLLERS
Route::get('pessoa','PessoaController@index');
Route::get('pessoa/{id}','PessoaController@show');
Route::get('pessoa/{nome}','PessoaController@showName');
Route::get('fisica','PessoaFisicaController@index');
Route::get('fisica/{id}','PessoaFisicaController@show');
Route::get('fisica/{name}','PessoaFisicaController@showName');
Route::get('juridica','PessoaJuridicaController@index');
Route::get('juridica/{id}','PessoaJuridicaController@show');
Route::get('juridica/{name}','PessoaJuridicaController@showName');
Route::get('cliente','ClienteController@index');
Route::get('cliente/{id}','ClienteController@show');
Route::get('cliente/fisica/{name}','ClienteController@showNameFis');
Route::get('cliente/juridica/{name}','ClienteController@showNameJur');
Route::get('funcionario','FuncionarioController@index');
Route::get('funcionario/{id}','FuncionarioController@show');
Route::get('funcionario/{name}','FuncionarioController@showName');
Route::get('processo','ProcessoController@index');
Route::get('processo/{id}','ProcessoController@show');
Route::get('processo/funcionario/{id}','ProcessoController@showIdFuncionario');
Route::get('processo/cliente/{id}','ProcessoController@showIdCliente');
Route::get('processo/{date}','ProcessoController@showDate');
Route::get('documento','DocumentoController@index');
Route::get('documento/{id}','DocumentoController@show');
Route::get('documento/processp/{id}','DocumentoController@showIdProcesso');
Route::get('documento/{date}','DocumentoController@showDate');
Route::get('documentoProcessual','DocumentoProcessualController@index');
Route::get('documentoProcessual/{id}','DocumentoProcessualController@show');
Route::get('documentoProcessual/processo/{id}','DocumentoProcessualController@showIdProcesso');
Route::get('documentoProcessual/{date}','DocumentoProcessualController@showDate');
Route::get('historico','HistoricoController@index');
Route::get('historico/{id}','HistoricoController@show');
Route::get('historico/processo/{id}','HistoricoController@showDateshowIdProcesso');
Route::get('historico/{date}','HistoricoController@showDate');
Route::get('erroLog','ErrorLogsController@index');
Route::get('erroLog{id}','ErrorLogsController@show');
Route::get('erroLog{date}','ErrorLogsController@showDate');
Route::get('acesso','AcessoController@index');
Route::get('acesso/{id}','AcessoController@show');
Route::get('acesso/funcionario/{id}','AcessoController@showIdFuncionario');
Route::get('acesso/{date}','AcessoController@showDate');

//POST ROUTES FOR CONTROLLERS
Route::post('pessoa','PessoaController@store');
Route::post('fisica','PessoaFisicaController@store');
Route::post('juridica','PessoaJuridicaController@store');
Route::post('cliente','ClienteController@store');
Route::post('funcionario','FuncionarioController@store');
Route::post('processo','ProcessoController@store');
Route::post('documento','DocumentoController@store');
Route::post('documentoProcessual','DocumentoProcessualController@store');
Route::post('historico','HistoricoController@store');
Route::post('erroLog','ErrorLogsController@store');
Route::post('acesso','AcessoController@store');


//PUT ROUTES FOR CONTROLLERS
Route::put('pessoa/{id}','PessoaController@update');
Route::put('fisica/{id}','PessoaFisicaController@update');
Route::put('juridica/{id}','PessoaJuridicaController@update');
Route::put('cliente/{id}','ClienteController@update');
Route::put('funcionario/{id}','FuncionarioController@update');
Route::put('processo/{id}','ProcessoController@update');
Route::put('documento/{id}','DocumentoController@update');
Route::put('documentoProcessual/{id}','DocumentoProcessualController@update');
Route::put('historico/{id}','HistoricoController@update');
Route::put('erroLog/{id}','ErrorLogsController@update');
Route::put('acesso/{id}','AcessoController@update');

//DELETE ROUTES FOR CONTROLLERS
Route::delete('pessoa/{id}','PessoaController@destroy');
Route::delete('fisica/{id}','PessoaFisicaController@destroy');
Route::delete('juridica/{id}','PessoaJuridicaController@destroy');
Route::delete('cliente/{id}','ClienteController@destroy');
Route::delete('funcionario/{id}','FuncionarioController@destroy');
Route::delete('processo/{id}','ProcessoController@destroy');
Route::delete('documento/{id}','DocumentoController@destroy');
Route::delete('documentoProcessual/{id}','DocumentoProcessualController@destroy');
Route::delete('historico/{id}','HistoricoController@destroy');
Route::delete('erroLog/{id}','ErrorLogsController@destroy');
Route::delete('acesso/{id}','AcessoController@destroy');
