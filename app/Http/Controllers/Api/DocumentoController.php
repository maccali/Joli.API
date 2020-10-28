<?php

namespace App\Http\Controllers\api;

use App\Console\Apoio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = Documento::all();

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
        $pessoa = Documento::find($id);

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
        $pessoa = DB::select('select * from documento 
                              where cod_processo = ?', [$id]);

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
        $pessoa = DB::select('select * from documento 
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
        $pessoa = DB::select('select * from documento 
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
        $pessoa = new Documento;
        $pessoa->documento = $request->documento;
        $pessoa['upload'] = Apoio::getTimestamp();
        $tipo = $pessoa['tipo'];
        $path = 'documento_' + $pessoa['processoId'] + '_' + $pessoa['upload'] + '.' + $tipo;
        $file = Storage::put($path, $request->files());
        $pessoa['documento'] = $path;
        
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
        $pessoa = Documento::find($id);
        $filep = Storage::get($pessoa['documento']);
        $antes = $pessoa;

        $pessoa->docuemnto = $request->documento;
        $pessoa['upload'] = Apoio::getTimestamp();
        $path = 'documento'+$pessoa['processoId']+$pessoa['upload']+'.txt';
        $file = Storage::put($path, $request->files());
        $pessoa['documento'] = $path;

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
        $pessoa = DB::select('select documento from documento where codigo = ?', [$id]);
        Storage::delete($pessoa);
        $pessoa = DB::delete('delete from docuemnto where codigo = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
