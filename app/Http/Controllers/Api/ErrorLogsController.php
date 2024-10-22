<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErroLog;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;

class ErrorLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $pessoas = ErroLog::all();

        if($request->csv == 'TRUE'){
            $ac = array_values((array)$pessoas)[0];
            $path = public_path() . '/tes.csv';
            $writer = Writer::createFromPath($path, 'w+');
            $writer->insertOne(['codigo', 'hora', 'log', 'errro']);
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
        $pessoa = ErroLog::find($id);

        if($request->csv == 'TRUE'){
            $ac = array_values((array)$pessoa)[0];
            $path = public_path() . '/tes.csv';
            $writer = Writer::createFromPath($path, 'w+');
            $writer->insertOne(['codigo', 'hora', 'log', 'errro']);
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
        $pessoa = DB::select('select * from error_logs_tabela 
                              where time = ?', [$date]);
        if($request->csv == 'TRUE'){
            $ac = array_values((array)$pessoa)[0];
            $path = public_path() . '/tes.csv';
            $writer = Writer::createFromPath($path, 'w+');
            $writer->insertOne(['codigo', 'hora', 'log', 'errro']);
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
        $pessoa = DB::select('select * from error_logs_tabela 
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
        $ar = array_values($request->all());
        $pessoa = DB::table('error_logs_tabela')->insert(
            ['time' => $ar[0], 'log' => $ar[1],
            'error' => $ar[2]],
            ['codigo']
        );

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
        $ar = array_values($request->all());
        //$pessoa = new ErroLog;
        $pessoa = DB::table('pessoa')->where('codigo', $id)->update(
            ['time' => $ar[0], 'log' => $ar[1],
            'error' => $ar[2]],
            ['codigo']
        );

        return response()->json($pessoa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pessoa = DB::delete('delete from error_logs_tabela where codigo = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
