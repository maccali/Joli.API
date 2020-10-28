<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = Cliente::all();

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
        $pessoa = Cliente::find($id);

        return response()->json($pessoa);
    }

    /**
     * Display the specified resource - id.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function showNameFis($name)
    {
        $pessoa = DB::select('select * from fisica f, pessoa p, cliente c
                              where f.cod_pessoa = p.codigo 
                              and f.cod_pessoa = c.cod_fisica 
                              and p.nome = ?', [$name]);

        return response()->json($pessoa);
    }

    /**
     * Display the specified resource - id.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function showNameJur($name)
    {
        $pessoa = DB::select('select * from juridica j, pessoa p, cliente c
                              where j.cod_pessoa = p.codigo 
                              and j.cod_pessoa = c.cod_juridica 
                              and p.nome = ?', [$name]);

        return response()->json($pessoa);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFis(Request $request)
    {
        $id = DB::select('select max(codigo) from pessoa');
        $id = $id + 1;
        $pessoa = new PessoaFisica;
        $pessoa->pessoa = $request->pessoa;
        $pessoa->setAttribute('fisicaId', $id);
        $pessoa->save();

        $cliente = new Cliente;
        $cliente['fisicaId'] = $id;
        $cliente['juridicaId'] = 0;
        $cliente->save();

        return response()->json([$pessoa, $cliente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeJur(Request $request)
    {
        $id = DB::select('select max(codigo) from pessoa');
        $id = $id + 1;
        $pessoa = new PessoaJuridica;
        $pessoa->pessoa = $request->pessoa;
        $pessoa->setAttribute('juridicaId', $id);
        $pessoa->save();

        $cliente = new Cliente;
        $cliente['fisicaId'] = 0;
        $cliente['juridicaId'] = $id;
        $cliente->save();

        return response()->json([$pessoa, $cliente]);
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
        $pessoa = Cliente::find($id);
        $antes = $pessoa;

        $pessoa->cliente = $request->cliente;

        $pessoa->update();

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
        $pessoa = DB::delete('delete from cliente where codigo = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
