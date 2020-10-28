<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Costume;
use Illuminate\Http\Request;
use Validator;

class CostumeController extends Controller
{
  public function index(Request $request)
  {

    $sociedadesUsuario = $request->all()['user']['sociedade'];

    if (!in_array('administrador', $sociedadesUsuario)) {
      return response()->json([
        "Você não tem acesso aqui"
      ], 401);
    }

      $costumes = Costume::all();

      return response()->json($costumes);
  }

  public function store(Request $request)
  {

    $sociedadesUsuario = $request->all()['user']['sociedade'];

    if (!in_array('administrador', $sociedadesUsuario)) {
      return response()->json([
        "Você não tem acesso aqui"
      ], 401);
    }

    $data = json_decode($request->getContent(), true);

    $validator = Validator::make(
      $data ,
      [
        'name' => 'required',
      ]
    );

    if ($validator->fails()){
      $messages = $validator->messages();
      return response()->json([$messages], 400);
    }

    $costume = Costume::where('name', $data['name'])->first();

    if($costume){
      return response()->json([
        "Costume Já existente"
      ], 400);
    }

    $costume = Costume::create($data);

    return response()->json($costume);
  }

  public function show(Request $request, $nome)
  {

    $sociedadesUsuario = $request->all()['user']['sociedade'];

    if (!in_array('administrador', $sociedadesUsuario)) {
      return response()->json([
        "Você não tem acesso aqui"
      ], 401);
    }

    $costume = Costume::where('name', $nome)->first();

    if(!$costume){
      return response()->json([
        "Costume Não Existe"
      ], 404);
    }

    return response()->json($costume);
  }

  public function update(Request $request, $nome)
  {

    $sociedadesUsuario = $request->all()['user']['sociedade'];

    if (!in_array('administrador', $sociedadesUsuario)) {
      return response()->json([
        "Você não tem acesso aqui"
      ], 401);
    }

    $data = json_decode($request->getContent(), true);

    $validator = Validator::make(
      $data ,
      [
        'name' => 'required',
      ]
    );

    if ($validator->fails()){
      $messages = $validator->messages();
      return response()->json([$messages], 400);
    }

    $costume = Costume::where('name', $nome)->first();

    if(!$costume){
      return response()->json([
        "Costume Não Encontrada"
      ], 404);
    }

    $costumeParaChecagem = Costume::where('name', $data['name'])->first();

    if($costumeParaChecagem){
      if($data['name'] !==$nome ){
        return response()->json([
          "Costume Já Existente"
        ], 400);
      }
    }

    $costume->name = $data['name'];
    $costume->description = $data['description'];
    $costume->save();

    return response()->json($data);

  }

  public function delete(Request $request, $nome)
  {

    $sociedadesUsuario = $request->all()['user']['sociedade'];

    if (!in_array('administrador', $sociedadesUsuario)) {
      return response()->json([
        "Você não tem acesso aqui"
      ], 401);
    }

    $costumesParaChecagem = Costume::where('name', $nome)->first();

    if(!$costumesParaChecagem){
      return response()->json([
        "Costume Não Encontrada"
      ], 404);
    }

    Costume::where('name', $nome)->delete();

    return  response()->json([
      'message'=> 'Excluida com Sucesso',
      'costume' => $costumesParaChecagem,
    ]);

  }
}
