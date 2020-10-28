<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = Pessoa::all();

        return response()->json($pessoas);
    }

    /**
     * Display the specified resource - id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pessoa = Pessoa::find($id);

        return response()->json($pessoa);
    }

    /**
     * Display the specified resource - id.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function showName($name)
    {
        $pessoa = DB::select('select * from pessoa where nome = ?', [$name]);

        return response()->json($pessoa);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pessoa = new Pessoa;
        $pessoa->pessoa = $request->pessoa;
        $pessoa->save();

        $id = DB::select('select max(codigo) from pessoa');

        return response()->json($pessoa);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFisicaCliente(Request $request)
    {
        $pessoa = new Pessoa;
        $pessoa->pessoa = $request->pessoa;
        $pessoa->save();

        $id = DB::select('select max(codigo) from pessoa');

        $pessoaf = new PessoaFisica;
        $pessoaf->pessoa = $request->pessoa;
        $pessoaf['fisicaId'] = $id;
        $pessoaf->save();

        $pessoac = new Cliente;
        $pessoac->cliente = $request->cliente;
        $pessoac['fisicaId'] = $id;
        $pessoac['juridicaId'] = 0;
        $pessoac->save();

        return response()->json([$pessoa, $pessoaf, $pessoac]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeJuridicaCliente(Request $request)
    {
        $pessoa = new Pessoa;
        $pessoa->pessoa = $request->pessoa;
        $pessoa->save();

        $id = DB::select('select max(codigo) from pessoa');

        $pessoaf = new PessoaFisica;
        $pessoaf->pessoaf = $request->pessoaf;
        $pessoaf['fisicaId'] = $id;
        $pessoaf->save();

        $pessoac = new Cliente;
        $pessoac->cliente = $request->cliente;
        $pessoac['fisicaId'] = 0;
        $pessoac['juridicaId'] = $id;
        $pessoac->save();

        return response()->json([$pessoa, $pessoaf, $pessoac]);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFisicaFuncionario(Request $request)
    {
        $pessoa = new Pessoa;
        $pessoa->pessoa = $request->pessoa;
        $pessoa->save();

        $id = DB::select('select max(codigo) from pessoa');

        $pessoaf = new PessoaFisica;
        $pessoaf->pessoaFisica = $request->pessoaFisica;
        $pessoaf->setAttribute('fisicaId', $id);
        $pessoaf->save();

        $pessoac = new Funcionario;
        $pessoac->funcionario = $request->funcionario;
        $pessoac->setAttribute('fisicaId', $id);
        $pessoac->save();

        return response()->json([$pessoa, $pessoaf, $pessoac]);
    }

            

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);
        $antes = $pessoa;

        $pessoa->pessoa = $request->pessoa;

        $pessoa->update();

        return response()->json([$antes, $pessoa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFisicaCliente(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);
        $antes = $pessoa;
        $pessoa->pessoa = $request->pessoa;
        $pessoa->update();

        $pessoaf = PessoaFisica::find($id);
        $antesf = $pessoa;
        $pessoaf->pessoa = $request->pessoa;
        $pessoaf->update();

        return response()->json([$antes, $pessoa, $antesf, $pessoaf]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateJuridicaCliente(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);
        $antes = $pessoa;
        $pessoa->pessoa = $request->pessoa;
        $pessoa->update();

        $pessoaf = PessoaJuridica::find($id);
        $antesf = $pessoa;
        $pessoaf->pessoa = $request->pessoa;
        $pessoaf->update();

        return response()->json([$antes, $pessoa, $antesf, $pessoaf]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFisicaFuncionario(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);
        $antes = $pessoa;
        $pessoa->pessoa = $request->pessoa;
        $pessoa->update();

        $pessoaf = PessoaFisica::find($id);
        $antesf = $pessoaf;
        $pessoaf->pessoa = $request->pessoaf;
        $pessoaf->update();

        $pessoau = Funcionario::find('cod_fisica', $id);
        $antesu = $pessoau;
        $pessoau->pessoa = $request->pessoau;
        $pessoau->update();

        return response()->json([$antes, $pessoa, $antesf, $pessoaf]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pessoa = DB::delete('delete from pessoa where codigo = ?', [$id]);

        return response()->json([$pessoa]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFisicaCliente($id)
    {
        $pessoa1 = DB::delete('delete from cliente where cod_fisica = ?', [$id]);
        $pessoa2 = DB::delete('delete from fisica where cod_pessoa = ?', [$id]);
        $pessoa3 = DB::delete('delete from pessoa where codigo = ?', [$id]);

        return response()->json([$pessoa1, $pessoa2, $pessoa3]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyJuridicaCliente($id)
    {
        $pessoa1 = DB::delete('delete from cliente where cod_juridica = ?', [$id]);
        $pessoa2 = DB::delete('delete from juridica where cod_pessoa = ?', [$id]);
        $pessoa3 = DB::delete('delete from pessoa where codigo = ?', [$id]);

        return response()->json([$pessoa1, $pessoa2, $pessoa3]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFisicaFuncionario($id)
    {
        $pessoa1 = DB::delete('delete from funcionario where cod_fisica = ?', [$id]);
        $pessoa2 = DB::delete('delete from fisica where cod_pessoa = ?', [$id]);
        $pessoa3 = DB::delete('delete from pessoa where codigo = ?', [$id]);

        return response()->json([$pessoa1, $pessoa2, $pessoa3]);
    }
}
