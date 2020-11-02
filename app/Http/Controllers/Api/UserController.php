<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $sociedadesUsuario = $request->all()['user']['sociedade'];

    if (!in_array('administrador', $sociedadesUsuario)) {
      return response()->json([
        "Você não tem acesso aqui"
      ], 401);
    }

    $users = User::all();
    return response()->json($users);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
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
        'email' => 'required',
        'password' => 'required',
        'sociedade' => 'required',
      ]
    );

    if ($validator->fails()) {
      $messages = $validator->messages();
      return response()->json([$messages], 400);
    }

    $usuario = User::where('email', $data['email'])->first();

    if ($usuario) {
      return response()->json([
        "Email Já existente"
      ], 400);
    }

    $usuario = User::create($data);

    return response()->json($usuario);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $id)
  {
    $sociedadesUsuario = $request->all()['user']['sociedade'];

    if (in_array('administrador', $sociedadesUsuario)) {
      $userHere = User::find($id);

      return response()->json($userHere);
    } else {
      return response()->json([
        "Você não tem acesso aqui"
      ], 401);
    }
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
        'email' => 'required',
        'password' => 'required',
        'sociedade' => 'required',
      ]
    );

    if ($validator->fails()) {
      $messages = $validator->messages();
      return response()->json([$messages], 400);
    }

    $user = User::where('userId', $id)->first();

    if (!$user) {
      return response()->json([
        "Usuário Não Encontrada"
      ], 404);
    }

    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->password = $data['password'];
    $user->sociedade = $data['sociedade'];
    $user->save();

    return response()->json($data);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function delete(Request $request, $id)
  {
    $sociedadesUsuario = $request->all()['user']['sociedade'];

    if (!in_array('administrador', $sociedadesUsuario)) {
      return response()->json([
        "Você não tem acesso aqui"
      ], 401);
    }


    $user = User::where('userId', $id)->first();

    if (!$user) {
      return response()->json([
        "Usuário Não Encontrada"
      ], 404);
    }

    User::where('userId', $id)->delete();

    return  response()->json([
      'message' => 'Excluida com Sucesso',
      'sociedade' => $user,
    ]);

  }
}
