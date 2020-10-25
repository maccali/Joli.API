<?php

namespace App\Http\Middleware;

use DateTime;
use Closure;
// use App\Models\ErroLog;

class LogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // $data['time'] = '';
        // $data['log'] = $response;
        // $data['error'] = $response->getStatusCode();

        // ErrorLog::create($data);

        // $log = new \ErrorLog;

        $log = $response;
        $error = $response->getStatusCode();

        // $log->save();

        \DB::insert('insert into error_logs(log, error)
                    values( ?, ?)', [$log, $error]);
        // 'time',
        // 'log',
        // 'error',
        // $response->status = 300
       return \Response::json([
          'success' => false,
          'message' => $response,
          'messagedsada' => $response->getStatusCode(),
    ], 200);

        // dd($request)
        // return response()->json(
        //   collect([
        //       'response' => 'success',
        //       'comments' => $response,
        //   ])->toJson()

        // return $response->json(['status' => 'kkkk'], 401)
        // return 'oi'
        // Do stuff
        return $response;
    }
}
