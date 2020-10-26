<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\PessoaJuridica;

class PessoaJuridicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = PessoaJuridica::all();

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
        $pessoa = PessoaJuridica::find($id);

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
        $pessoa = DB::select('select * from juridicas f, pessoas p 
                              where f.juridicaId = p.pessoaId 
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
        $pessoa = new PessoaJuridica;
        $pessoa->juridica = $request->juridica;
        $pessoa->setAttribute('juridicaId', $id);
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
        $pessoa = new PessoaJuridica;
        $pessoa->pessoaJuridica = $request->pessoaJuridica;
        $pessoa->setAttribute('juridicaId', $id);
        $pessoa->save();

        $pessoaj = new Cliente;
        $pessoaj->cliente = $request->cliente;
        $pessoaj->setAttribute('juridicaId', $id);
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
        $pessoa = PessoaJuridica::find($id);
        $antes = $pessoa;

        $pessoa->juridica = $request->juridica;

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
        $pessoa = DB::delete('delete from juridicas where juridicaId = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
