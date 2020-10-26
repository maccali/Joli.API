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
        $pessoa = DB::select('select * from pessoas where nome = ?', [$name]);

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

        $id = DB::select('select max(pessoaId) from pessoas');

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

        $id = DB::select('select max(pessoaId) from pessoas');

        $pessoaf = new PessoaFisica;
        $pessoaf->pessoa = $request->pessoa;
        $pessoaf->setAttribute('fisicaId', $id);
        $pessoaf->save();

        $pessoac = new Cliente;
        $pessoac->cliente = $request->cliente;
        $pessoac->setAttribute('juridicaId', $id);
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

        $id = DB::select('select max(pessoaId) from pessoas');

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeJuridica(Request $request)
    {
        $pessoa = new Pessoa;
        $pessoa->pessoa = $request->pessoa;
        $pessoa->save();

        $id = DB::select('select max(pessoaId) from pessoas');

        $pessoaj = new PessoaJuridica;
        $pessoaj->pessoa = $request->pessoa;
        $pessoaj->setAttribute('juridicaId', $id);
        $pessoaj->save();

        $pessoac = new Cliente;
        $pessoac->cliente = $request->cliente;
        $pessoac->setAttribute('juridicaId', $id);
        $pessoac->save();

        return response()->json([$pessoa, $pessoaj, $pessoac]);
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

        $pessoa->save();

        return response()->json([$antes, $pessoa]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pessoa = DB::delete('delete from pessoas where pessoaId = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
