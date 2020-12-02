<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Processo;
use App\Models\User;
use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailProcesso;

class ProcessoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $processos = Processo::orderBy('codigo', 'desc')->get();

    return response()->json($processos);
  }

  public function indexIdent($ident)
  {
    $processos = Processo::withTrashed()
      ->where('cod_processo', $ident)
      ->orderBy('codigo', 'desc')->get();

    return response()->json($processos);
  }

  /**
   * Display the specified resource - id.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $processo = Processo::find($id);

    return response()->json($processo);
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

    $hash =  strtoupper(Str::random(7));

    $fileDocumento = $request->file('documento');
    $fileDocumentoProcessual = $request->file('documento_processual');

    $storeDocumento = Storage::disk('public')->put($hash, $fileDocumento);
    $storeDocumentoProcessual = Storage::disk('public')->put($hash, $fileDocumentoProcessual);

    $processoDados = [
      "cod_cliente" => $fields['cod_cliente'],
      "cod_funcionario" => $fields['user']['userId'],
      "cod_processo" => $hash,
      "numero" => $fields['numero'],
      "processo_tipo" => $fields['processo_tipo'],
      "abertura" => $fields['abertura'],
      "documento" => "/storage/" . $storeDocumento,
      "documento_processual" => "/storage/" . $storeDocumentoProcessual,

    ];

    $processo = Processo::create($processoDados);
    $user = User::where('userId', $fields['user']['userId'])->first();
    $pessoa = Pessoa::where('codigo', $fields['cod_cliente'])->first();
    $acao = 'Criação de Processo';

    Mail::to('smtppictu@gmail.com')->send(new SendEmailProcesso($user, $processo, $pessoa, $acao));

    return response()->json([
      'processo' => $processo,
      'criador' => $user,
      'cliente' => $pessoa,
    ]);
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

    if ($request->hasFile('documento')) {
      $fileDocumento = $request->file('documento');
      $storeDocumento = Storage::disk('public')->put($cod_processo, $fileDocumento);
      $documentoLink = "/storage/" . $storeDocumento;
    } else {
      $documentoLink['documento'] = $processoOld->documento;
    }

    if ($request->hasFile('documento_processual')) {
      $fileDocumentoProcessual = $request->file('documento_processual');
      $storeDocumentoProcessual = Storage::disk('public')->put($cod_processo, $fileDocumentoProcessual);
      $documentoProcessualLink = "/storage/" . $storeDocumentoProcessual;
    } else {
      $documentoProcessualLink = $processoOld->documento_processual;
    }

    $processoDados = [
      "cod_cliente" => $processoOld->cod_cliente,
      "cod_funcionario" => $processoOld->cod_funcionario,
      "cod_processo" => $processoOld->cod_processo,
      "numero" => $fields['numero'],
      "processo_tipo" => $fields['processo_tipo'],
      "abertura" => $fields['abertura'],
      "documento" => $documentoLink,
      "documento_processual" => $documentoProcessualLink,

    ];

    $processoOld->delete();

    $processo = Processo::create($processoDados);
    $user = User::where('userId', $processoOld->cod_funcionario)->first();
    $pessoa = Pessoa::where('codigo', $processoOld->cod_cliente)->first();
    $acao = 'Edição de Processo';

    Mail::to('smtppictu@gmail.com')->send(new SendEmailProcesso($user, $processo, $pessoa, $acao));

    return response()->json([
      'processo' => $processo,
      'criador' => $user,
      'cliente' => $pessoa,
    ]);
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

  public function destroyIdent($ident)
  {

    $processoParaChecagem = Processo::where('cod_processo', $ident)->first();

    if (!$processoParaChecagem) {
      return response()->json([
        "Processo Não Encontrada"
      ], 404);
    }

    Processo::where('cod_processo', $ident)->delete();

    return  response()->json([
      'message' => 'Excluida com Sucesso',
      'processo' => $processoParaChecagem,
    ]);
  }
}
