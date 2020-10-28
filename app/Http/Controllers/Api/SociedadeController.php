<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Sociedade;
use Illuminate\Http\Request;
use Validator;

class SociedadeController extends Controller
{
  public function index(Request $request)
  {
    $sociedadesUsuario = $request->all()['user']['sociedade'];

    if (!in_array('administrador', $sociedadesUsuario)) {
      return response()->json([
        "Você não tem acesso aqui"
      ], 401);
    }

    $sociedades = Sociedade::all();
    return response()->json($sociedades);
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
      $data,
      [
        'name' => 'required',
      ]
    );

    if ($validator->fails()) {
      $messages = $validator->messages();
      return response()->json([$messages], 400);
    }

    $sociedade = Sociedade::where('name', $data['name'])->first();

    if ($sociedade) {
      return response()->json([
        "Sociedade Já existente"
      ], 400);
    }

    $sociedade = Sociedade::create($data);

    return response()->json($sociedade);
  }

  public function show(Request $request, $nome)
  {

    $sociedadesUsuario = $request->all()['user']['sociedade'];

    if (!in_array('administrador', $sociedadesUsuario)) {
      return response()->json([
        "Você não tem acesso aqui"
      ], 401);
    }

    $sociedade = Sociedade::where('name', $nome)->first();

    if (!$sociedade) {
      return response()->json([
        "Sociedade Não Existe"
      ], 404);
    }

    return response()->json($sociedade);
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
      $data,
      [
        'name' => 'required',
      ]
    );

    if ($validator->fails()) {
      $messages = $validator->messages();
      return response()->json([$messages], 400);
    }

    $sociedade = Sociedade::where('name', $nome)->first();

    if (!$sociedade) {
      return response()->json([
        "Sociedade Não Encontrada"
      ], 404);
    }

    $sociedadeParaChecagem = Sociedade::where('name', $data['name'])->first();

    if ($sociedadeParaChecagem) {
      if ($data['name'] !== $nome) {
        return response()->json([
          "Sociedade Já Existente"
        ], 400);
      }
    }

    $sociedade->name = $data['name'];
    $sociedade->description = $data['description'];
    $sociedade->list = $data['list'];
    $sociedade->save();

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

    $sociedadeParaChecagem = Sociedade::where('name', $nome)->first();

    if (!$sociedadeParaChecagem) {
      return response()->json([
        "Sociedade Não Encontrada"
      ], 404);
    }

    Sociedade::where('name', $nome)->delete();

    return  response()->json([
      'message' => 'Excluida com Sucesso',
      'sociedade' => $sociedadeParaChecagem,
    ]);
  }
}
