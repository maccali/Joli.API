<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErroLog;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuditHistoriesController extends Controller
{
  public function index(Request $request, ErroLog $erroLog)
  {
    $sociedadesUsuario = $request->all()['user']['sociedade'];

    if (!in_array('administrador', $sociedadesUsuario)) {
      return response()->json([
        "Você não tem acesso aqui"
      ], 401);
    }

    $data = $request->all();
    $erroLog = $erroLog->newQuery();

    if (isset($data['status'])) {
      $erroLog->where('status', $data['status']);
    }
    if (isset($data['email'])) {
      $erroLog->whereJsonContains('operator', ['email' => $data['email']]);
    }

    if (isset($data['limit'])) {
      $erroLog->paginate($data['limit']);
    } else {
      $erroLog->paginate(10);
    }

    return response()->json($erroLog->orderBy('auditHistoryId','desc')->get(), 200);
  }
}
