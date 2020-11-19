<?php

namespace App\Http\Controllers\api;

use App\Console\Apoio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Documento;
use Exception;
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
        $path = $pessoa["documento"];

        return response()->download(public_path() . $path);
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
        $path = $pessoa["documento"];

        return response()->download(public_path() . $path);
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
        $path = $pessoa["documento"];

        return response()->download(public_path() . $path);
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
    {/*
        $pessoa = new Documento;
        $pessoa->documento = $request->documento;
        $pessoa['upload'] = Apoio::getTimestamp();
        $tipo = $pessoa['tipo'];
        $path = 'documento_' + $pessoa['processoId'] + '_' + $pessoa['upload'] + '.' + $tipo;
        $file = Storage::put($path, $request->files());
        $pessoa['documento'] = $path;
        
        $pessoa->save();

        return response()->json($pessoa);*/

        $format = $request->input('formato');
        $data = array_values([$request->input("formato"), $request->input('nome'), 
                              $request->input("upload"), $request->input("procId")]);
        
        $path = public_path() . 'Documento_' . $data[1] . '_' . $data[2] . $format;
        $file = $request->file()->storeAs('', $path);

        return response()->json([$path]);

        $insDoc = DB::table('documento_processual')->insert(
            ['tipo' => $data[0], 'nome' => $data[1], 'documento' => $path,
             'upload' => $data[2], 'cod_processo' => $data[3]]
        );

        return response()->json([$insDoc, $file]);
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
        
        $format = $request->input('formato');
        $data = array_values($request->all());
        
        $path = 'Documento_' + $data[1] + '_' + $data[3] + $format;
        $file = $request->file()->storeAs('', $path);

        $insDoc = DB::table('documento_processual')->where('codigo', $id)->update(
            ['tipo' => $data[0], 'nome' => $data[1], 'documento' => $data[2],
             'processoId' => $data[3], 'upload' => $data[4], 'cod_processo' => $data[5]]
        );

        return response()->json([$insDoc, $file]);
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
        unlink($pessoa['documento']);
        $pessoa = DB::delete('delete from docuemnto where codigo = ?', [$id]);

        return response()->json([$pessoa]);
    }
}
