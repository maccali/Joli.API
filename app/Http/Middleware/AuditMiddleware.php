<?php

namespace App\Http\Middleware;

use DateTime;
use Closure;
use Illuminate\Support\Facades\DB;

class AuditMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $time = new DateTime();
        $status = $response->getStatusCode();
        $operator = $request->user;

        $requestFiltered = [
          'url' => $request->url(),
          'fulUrl' => $request->fullUrl(),
          'method' => $request->method(),
          'all' => $request->all(),
          'ip' => $request->ip(),
        ];

        $responseFiltered = [
          'status' => $response->getStatusCode(),
          'original' => $response->original,
        ];

        $requestFiltered = json_encode($requestFiltered);
        $responseFiltered = json_encode($responseFiltered);
        $operator = json_encode($operator);

        \DB::insert('insert into audit_histories(time, status, operator, request, response)
                    values( ?, ?, ?, ?, ?)', [$time, $status, $operator, $requestFiltered, $responseFiltered]);

        return $response;
    }
}
