<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PessoaFisica;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = Funcionario::all();

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
        $pessoa = Funcionario::find($id);

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
        $pessoa = DB::select('select * from fisicas f, pessoas p, funcionarios u 
                              where f.fisicaId = p.pessoaId 
                              and u.fisicaId = f.fisicaId 
                              and p.nome = ?', [$name]);

        return response()->json($pessoa);
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
        $pessoa->pessoaFisica = $request->pessoaFisica;
        $pessoa['fisicaId'] = $id;
        $pessoa->save();

        $func = new Funcionario;
        $func->funcionario = $request->funcionario;
        $func['fisicaId'] = $id;
        $func->save();

        return response()->json([$pessoa, $func]);
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
        $pessoaj = new Funcionario;
        $pessoaj->funcionario = $request->funcionario;
        $pessoaj->setAttribute('fisicaId', $id);
        $pessoaj->save();

        return response()->json($pessoaj);
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
        $pessoa = Funcionario::find($id);
        $antes = $pessoa;

        $pessoa->funcionario = $request->funcionario;

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
        $pessoa = DB::delete('delete from funcionarios where funcionarioId = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
