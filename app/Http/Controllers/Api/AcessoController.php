<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Acesso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use League\Csv\Writer;

class AcessoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $pessoas = Acesso::all();
        if($request->csv == 'TRUE'){
            $ac = array_values((array)$pessoas)[0];
            $path = public_path() . '/tes.csv';
            $writer = Writer::createFromPath($path, 'w+');
            $writer->insertOne(['codigo', 'hora', 'ip', 'feito', 'funcionario']);
            $writer->insertAll($ac);

            return response()->download($path);
        }

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
        $pessoa = Acesso::find($id);
        if($request->csv == 'TRUE'){
            $ac = array_values((array)$pessoa)[0];
            $path = public_path() . '/tes.csv';
            $writer = Writer::createFromPath($path, 'w+');
            $writer->insertOne(['codigo', 'hora', 'ip', 'feito', 'funcionario']);
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
        $pessoa = DB::select('select * from acessos 
                              where funcionarioId = ?', [$id]);
        if($request->csv == 'TRUE'){
            $ac = array_values((array)$pessoa)[0];
            $path = public_path() . '/tes.csv';
            $writer = Writer::createFromPath($path, 'w+');
            $writer->insertOne(['codigo', 'hora', 'ip', 'feito', 'funcionario']);
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
    public function showDate(Request $request, $date)
    {
        $pessoa = DB::select('select * from acessos 
                              where time = ?', [$date]);
        if($request->csv == 'TRUE'){
            $ac = array_values((array)$pessoa)[0];
            $path = public_path() . '/tes.csv';
            $writer = Writer::createFromPath($path, 'w+');
            $writer->insertOne(['codigo', 'hora', 'ip', 'feito', 'funcionario']);
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
    public function showDates($date1, $date2)
    {
        $pessoa = DB::select('select * from acesso 
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
        $pessoa = DB::delete('delete from acesso where codigo = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
