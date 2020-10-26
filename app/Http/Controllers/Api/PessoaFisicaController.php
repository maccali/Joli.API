<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\PessoaFisica;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;

class PessoaFisicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = PessoaFisica::all();

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
        $pessoa = PessoaFisica::find($id);

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
        $pessoa = DB::select('select * from fisicas f, pessoas p 
                              where f.fisicaId = p.pessoaId 
                              and p.nome = ?', [$name]);

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
        $id = DB::select('select max(pessoaId) from pessoas');
        $pessoa = new PessoaFisica;
        $pessoa->pessoa = $request->pessoa;
        $pessoa->setAttribute('fisicaId', $id);
        $pessoa->save();

        return response()->json($pessoa);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCliente(Request $request)
    {
        $id = DB::select('select max(pessoaId) from pessoas');
        $pessoa = new PessoaFisica;
        $pessoa->pessoaFisica = $request->pessoaFisica;
        $pessoa->setAttribute('fisicaId', $id);
        $pessoa->save();

        $pessoaj = new Cliente;
        $pessoaj->cliente = $request->cliente;
        $pessoaj->setAttribute('fisicaId', $id);
        $pessoaj->save();

        return response()->json([$pessoa, $pessoaj]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFuncionario(Request $request)
    {
        $id = DB::select('select max(pessoaId) from pessoas');
        $pessoa = new PessoaFisica;
        $pessoa->fisica = $request->fisica;
        $pessoa->setAttribute('fisicaId', $id);
        $pessoa->save();

        $pessoaj = new Funcionario;
        $pessoaj->funcionario = $request->funcionario;
        $pessoaj->setAttribute('fisicaId', $id);
        $pessoaj->save();

        return response()->json([$pessoa, $pessoaj]);
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
        $pessoa = PessoaFisica::find($id);
        $antes = $pessoa;

        $pessoa->fisica = $request->fisica;

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
        $pessoa = DB::delete('delete from fisicas where fisicaId = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
