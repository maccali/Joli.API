<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Acesso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\ErroLog;
use App\Models\Processo;
use App\Models\User;

class DashboardController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function countAudit()
  {
    $total = ErroLog::count();

    return response()->json(['total' => $total]);
  }

  public function countProcessos()
  {
    $total = Processo::count();

    return response()->json(['total' => $total]);
  }

  public function countUsuarios()
  {
    $total = User::count();

    return response()->json(['total' => $total]);
  }
}
