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
Route::get('pessoa','Api\PessoaController@index');
Route::get('pessoa/{id}','Api\PessoaController@show');
Route::get('pessoa/{nome}','Api\PessoaController@showName');
Route::get('fisica','Api\PessoaFisicaController@index');
Route::get('fisica/{id}','Api\PessoaFisicaController@show');
Route::get('fisica/{name}','Api\PessoaFisicaController@showName');
Route::get('juridica','Api\PessoaJuridicaController@index');
Route::get('juridica/{id}','Api\PessoaJuridicaController@show');
Route::get('juridica/{name}','Api\PessoaJuridicaController@showName');
Route::get('cliente','Api\ClienteController@index');
Route::get('cliente/{id}','Api\ClienteController@show');
Route::get('cliente/fisica/{name}','Api\ClienteController@showNameFis');
Route::get('cliente/juridica/{name}','Api\ClienteController@showNameJur');
Route::get('funcionario','Api\FuncionarioController@index');
Route::get('funcionario/{id}','Api\FuncionarioController@show');
Route::get('funcionario/{name}','Api\FuncionarioController@showName');
Route::get('processo','Api\ProcessoController@index');
Route::get('processo/{id}','Api\ProcessoController@show');
Route::get('processo/funcionario/{id}','Api\ProcessoController@showIdFuncionario');
Route::get('processo/cliente/{id}','Api\ProcessoController@showIdCliente');
Route::get('processo/{date}','Api\ProcessoController@showDate');
Route::get('documento','Api\DocumentoController@index');
Route::get('documento/{id}','Api\DocumentoController@show');
Route::get('documento/processp/{id}','Api\DocumentoController@showIdProcesso');
Route::get('documento/{date}','Api\DocumentoController@showDate');
Route::get('documentoProcessual','Api\DocumentoProcessualController@index');
Route::get('documentoProcessual/{id}','Api\DocumentoProcessualController@show');
Route::get('documentoProcessual/processo/{id}','Api\DocumentoProcessualController@showIdProcesso');
Route::get('documentoProcessual/{date}','Api\DocumentoProcessualController@showDate');
Route::get('historico','Api\HistoricoController@index');
Route::get('historico/{id}','Api\HistoricoController@show');
Route::get('historico/processo/{id}','Api\HistoricoController@showDateshowIdProcesso');
Route::get('historico/{date}','Api\HistoricoController@showDate');
Route::get('erroLog','Api\ErrorLogsController@index');
Route::get('erroLog{id}','Api\ErrorLogsController@show');
Route::get('erroLog{date}','Api\ErrorLogsController@showDate');
Route::get('acesso','Api\AcessoController@index');
Route::get('acesso/{id}','Api\AcessoController@show');
Route::get('acesso/funcionario/{id}','Api\AcessoController@showIdFuncionario');
Route::get('acesso/{date}','Api\AcessoController@showDate');

//POST ROUTES FOR CONTROLLERS
Route::post('pessoa','Api\PessoaController@store');
Route::post('pessoa/fisica/cliente','Api\PessoaController@storeFisicaCliente');
Route::post('pessoa/juridica/cliente','Api\PessoaController@storeJuridicaCliente');
Route::post('pessoa/fisica/funcionario','Api\PessoaController@storeFisicaFuncionario');
Route::post('fisica','Api\PessoaFisicaController@store');
Route::post('juridica','Api\PessoaJuridicaController@store');
Route::post('cliente','Api\ClienteController@store');
Route::post('funcionario','Api\FuncionarioController@store');
Route::post('processo','Api\ProcessoController@store');
Route::post('documento','Api\DocumentoController@store');
Route::post('documentoProcessual','Api\DocumentoProcessualController@store');
Route::post('historico','Api\HistoricoController@store');
Route::post('erroLog','Api\ErrorLogsController@store');
Route::post('acesso','Api\AcessoController@store');


//PUT ROUTES FOR CONTROLLERS
Route::put('pessoa/{id}','Api\PessoaController@update');
Route::put('pessoa/fisica/cliente/{id}','Api\PessoaController@updateFisicaCliente');
Route::put('pessoa/juridica/cliente/{id}','Api\PessoaController@updateJuridicaCliente');
Route::put('pessoa/fisica/funcionario/{id}','Api\PessoaController@updateFisicaFuncionario');
Route::put('fisica/{id}','Api\PessoaFisicaController@update');
Route::put('juridica/{id}','Api\PessoaJuridicaController@update');
Route::put('cliente/{id}','Api\ClienteController@update');
Route::put('funcionario/{id}','Api\FuncionarioController@update');
Route::put('processo/{id}','Api\ProcessoController@update');
Route::put('documento/{id}','Api\DocumentoController@update');
Route::put('documentoProcessual/{id}','Api\DocumentoProcessualController@update');
Route::put('historico/{id}','Api\HistoricoController@update');
Route::put('erroLog/{id}','Api\ErrorLogsController@update');
Route::put('acesso/{id}','Api\AcessoController@update');

//DELETE ROUTES FOR CONTROLLERS
Route::delete('pessoa/{id}','Api\PessoaController@destroy');
Route::delete('pessoa/fisica/cliente/{id}','Api\PessoaController@destroyFisicaCliente');
Route::delete('pessoa/juridica/cliente/{id}','Api\PessoaController@destroyJuridicaCliente');
Route::delete('pessoa/fisica/funcionario/{id}','Api\PessoaController@destroyFisicaFuncionario');
Route::delete('fisica/{id}','Api\PessoaFisicaController@destroy');
Route::delete('juridica/{id}','Api\PessoaJuridicaController@destroy');
Route::delete('cliente/{id}','Api\ClienteController@destroy');
Route::delete('funcionario/{id}','Api\FuncionarioController@destroy');
Route::delete('processo/{id}','Api\ProcessoController@destroy');
Route::delete('documento/{id}','Api\DocumentoController@destroy');
Route::delete('documentoProcessual/{id}','Api\DocumentoProcessualController@destroy');
Route::delete('historico/{id}','Api\HistoricoController@destroy');
Route::delete('erroLog/{id}','Api\ErrorLogsController@destroy');
Route::delete('acesso/{id}','Api\AcessoController@destroy');
