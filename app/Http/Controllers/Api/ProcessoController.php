<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Processo;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;

class ProcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = Processo::all();

        return response()->json($pessoas);
    }

    /**
     * Display the specified resource - id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $pessoa = Processo::find($id);

        if($request->csv == 'TRUE'){
            $ac = array_values((array)$pessoa)[0];
            $path = public_path() . '/tes.csv';
            $writer = Writer::createFromPath($path, 'w+');
            $writer->insertOne(['codigo', 'cliente', 'funcionario', 'numero', 
                                'tipo', 'abertura']);
            $writer->insertAll($ac);
            return response()->download($path);
        }
        

        return response()->json($pessoa);
    }

    /**
     * Display the specified resource - funcionarioId.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showIdFuncionario(Request $request, $id)
    {
        $pessoa = DB::select('select * from processo 
                              where cod_funcionario = ?', [$id]);
        if($request->csv == 'TRUE'){
            $ac = array_values((array)$pessoa)[0];
            $path = public_path() . '/tes.csv';
            $writer = Writer::createFromPath($path, 'w+');
            $writer->insertOne(['codigo', 'cliente', 'funcionario', 'numero', 
                                'tipo', 'abertura']);
            $writer->insertAll($ac);
            return response()->download($path);
        }

        return response()->json($pessoa);
    }

    /**
     * Display the specified resource - funcionarioId.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showIdCliente(Request $request, $id)
    {
        $pessoa = DB::select('select * from processo 
                              where cod_cliente = ?', [$id]);

        if($request->csv == 'TRUE'){
            $ac = array_values((array)$pessoa)[0];
            $path = public_path() . '/tes.csv';
            $writer = Writer::createFromPath($path, 'w+');
            $writer->insertOne(['codigo', 'cliente', 'funcionario', 'numero', 
                                'tipo', 'abertura']);
            $writer->insertAll($ac);
            return response()->download($path);
        }

        return response()->json($pessoa);
    }

    /**
     * Display the specified resource - funcionarioId.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDate($date)
    {
        $pessoa = DB::select('select * from processo 
                              where abertura = ?', [$date]);

        return response()->json($pessoa);
    }

    /**
     * Display the specified resource - funcionarioId.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDates($date1, $date2)
    {
        $pessoa = DB::select('select * from processo 
                              where abertura between ? and ?', [$date1, $date2]);

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
        $data = $request->all();
        $ar = array_values($data);

        $insProc = DB::table('processo')->insert(
            ['cod_cliente' => $ar[0], 'cod_funcionario' => $ar[1],
             'numero' => $ar[2], 'processo_tipo' => $ar[3],
             'abertura' => $ar[4]],
             ['codigo']
        );

        return response()->json($insProc);
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
        $data = $request->all();
        $ar = array_values($data);

        $insProc = DB::table('processo')->where('codigo', $id)->update(
            ['cod_cliente' => $ar[0], 'cod_funcionario' => $ar[1],
             'numero' => $ar[2], 'processo_tipo' => $ar[3],
             'abertura' => $ar[4]],
             ['codigo']
        );

        return response()->json($insProc);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pessoa = DB::delete('delete from processo where codigo = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
