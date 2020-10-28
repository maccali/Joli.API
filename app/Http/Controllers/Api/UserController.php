<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

        if(in_array('administrador', $sociedadesUsuario)){
          $users = User::all();
          return response()->json($users);
        }else{
          return response()->json([
            "Você não tem acesso aqui"
          ], 401);
        }
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
        //
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

      if(in_array('administrador', $sociedadesUsuario)){
        $user = User::find($id);

        return response()->json($user);
      }else{
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

      if(in_array('administrador', $sociedadesUsuario)){

      }else{
        return response()->json([
          "Você não tem acesso aqui"
        ], 401);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      $sociedadesUsuario = $request->all()['user']['sociedade'];

      if(in_array('administrador', $sociedadesUsuario)){

      }else{
        return response()->json([
          "Você não tem acesso aqui"
        ], 401);
      }
        //
    }
}
