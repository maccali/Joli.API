<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Processo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProcessoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $pessoas = Processo::all();

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
    $pessoa = Processo::find($id);

    return response()->json($pessoa);
  }

  /**
   * Display the specified resource - funcionarioId.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function showIdFuncionario($id)
  {
    $pessoa = DB::select('select * from processo
                              where cod_funcionario = ?', [$id]);

    return response()->json($pessoa);
  }

  /**
   * Display the specified resource - funcionarioId.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function showIdCliente($id)
  {
    $pessoa = DB::select('select * from processo
                              where cod_cliente = ?', [$id]);

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

    $fields = $request->all();


    $processoDados = [
      "cod_cliente" => $fields['cod_cliente'],
      "cod_funcionario" => $fields['user']['userId'],
      "cod_processo" => strtoupper(Str::random(7)),
      "numero" => $fields['numero'],
      "processo_tipo" => $fields['processo_tipo'],
      "abertura" => $fields['abertura'],
      "documento" => $fields['documento'],
      "documento_processual" => $fields['documento_processual'],

    ];

    $processo = Processo::create($processoDados);

    return response()->json($processo);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {

    $fields = $request->all();

    $cod_processo = $fields['cod_processo'];

    $processoOld = Processo::where('cod_processo', $cod_processo)->first();

    $processoDados = [
      "cod_cliente" => $processoOld->cod_cliente,
      "cod_funcionario" => $processoOld->cod_funcionario,
      "cod_processo" => $processoOld->cod_processo,
      "numero" => $fields['numero'],
      "processo_tipo" => $fields['processo_tipo'],
      "abertura" => $fields['abertura'],
      "documento" => $fields['documento'],
      "documento_processual" => $fields['documento_processual'],

    ];

    $processoOld->delete();

    $processo = Processo::create($processoDados);

    return response()->json($processo);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {

    $processoParaChecagem = Processo::where('codigo', $id)->first();

    if (!$processoParaChecagem) {
      return response()->json([
        "Processo Não Encontrada"
      ], 404);
    }

    Processo::where('codigo', $id)->delete();

    return  response()->json([
      'message' => 'Excluida com Sucesso',
      'processo' => $processoParaChecagem,
    ]);
  }
}
