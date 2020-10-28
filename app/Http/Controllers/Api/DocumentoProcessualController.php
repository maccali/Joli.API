<?php

namespace App\Http\Controllers\api;

use App\Console\Apoio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentoProcessual;
use Illuminate\Support\Facades\Storage;

class DocumentoProcessualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = DocumentoProcessual::all();

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
        $pessoa = DocumentoProcessual::find($id);

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
        $pessoa = DB::select('select * from documentos_processual 
                              where codigo = ?', [$id]);

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
        $pessoa = DB::select('select * from documentos_processual 
                              where upload = ?', [$date]);

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
        $pessoa = DB::select('select * from documentos_processual 
                              where upload between ? and ?', [$date1, $date2]);

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
        $pessoa = new DocumentoProcessual;
        $pessoa->documento = $request->documento;
        $pessoa['upload'] = Apoio::getTimestamp();
        $path = 'processo_' + $pessoa['processoId'] + '_' + $pessoa['upload'] + '.txt';
        $file = Storage::put($path, $request->files());
        $pessoa['processo'] = $path;
        
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
        $pessoa = DocumentoProcessual::find($id);
        $filep = Storage::get($pessoa['processo']);
        $antes = $pessoa;

        $pessoa->docuemnto = $request->documento;
        $pessoa['upload'] = Apoio::getTimestamp();
        $path = 'processo_' + $pessoa['processoId'] + '_' + $pessoa['upload'] + '.txt';
        Storage::put($path, $request->files());
        $pessoa['processo'] = $path;

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
        $pessoa = DB::select('select processo from documentos_processual where codigo = ?', [$id]);
        Storage::delete($pessoa);
        $pessoa = DB::delete('delete from documentos_processual where codigo = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
