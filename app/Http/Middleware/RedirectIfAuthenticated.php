<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Console\Apoio;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $time = Apoio::getTimestamp();
        $ip = Apoio::getIp($request);
        $id = json_decode($request->json(), true);
        // insert error to DB -> acesso --- auditoria
        DB::insert('insert into acesso(time, ip, feito, cod_funcionario)
                    values(?, ?, ?, ?)', [$time, $ip, $request->json()->all, $id[0]]);
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
