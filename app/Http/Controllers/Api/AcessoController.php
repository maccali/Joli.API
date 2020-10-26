<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Acesso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = Acesso::all();

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
        $pessoa = Acesso::find($id);

        return response()->json($pessoa);
    }

    /**
     * Display the specified resource - funcionarioId.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showId($id)
    {
        $pessoa = DB::select('select * from acessos 
                              where funcionarioId = ?', [$id]);

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
        $pessoa = DB::select('select * from acessos 
                              where time = ?', [$date]);

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
        $pessoa = DB::select('select * from acessos 
                              where time between ? and ?', [$date1, $date2]);

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
        $pessoa = new Acesso;
        $pessoa->pessoa = $request->pessoa;
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
        $pessoa = Acesso::find($id);
        $antes = $pessoa;

        $pessoa->acesso = $request->acesso;

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
        $pessoa = DB::delete('delete from acessos where acessoId = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
