<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Historicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoricoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = Historicos::all();

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
        $pessoa = Historicos::find($id);

        return response()->json($pessoa);
    }

    /**
     * Display the specified resource - funcionarioId.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showIdProcesso($id)
    {
        $pessoa = DB::select('select h.historicoId, h.fase, h.data 
                              from historicos h, processos p 
                              where p.historicoId = h.historicoId 
                              and p.historicoId = ?', [$id]);

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
        $pessoa = DB::select('select * from historicos 
                              where data = ?', [$date]);

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
        $pessoa = DB::select('select * from historicos 
                              where data between ? and ?', [$date1, $date2]);

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
        $pessoa = new Historicos;
        $pessoa->historico = $request->historico;
        $pessoa->save();

        return response()->json($pessoa);
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
        $pessoa = Historicos::find($id);
        $antes = $pessoa;

        $pessoa->historico = $request->historico;

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
        $pessoa = DB::delete('delete from historicos where historicoId = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
