<?php

namespace App\Exceptions;

use App\Console\Apoio;
use DateTime;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\DB;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        // $date = new DateTime();
        // $time = date('d-m-Y', strtotime($date->getTimestamp()));
        // // insert error to DB -> error_logs
        // $erro = new ErroLog();
        // $erro['time'] = $time;
        // $erro['log'] = $exception->gettype;
        // $erro['error'] = $exception->getMessage();
        // $erro->save();
        /*
        DB::table('error_logs_tabela')->insert(
            ['time' => Apoio::getTimestamp(), 
             'log' => $exception->getFile() . ', ' . $exception->getLine() . ', ' . $exception->getMessage(),
             'error' => $exception->getCode()],
            ['codigo']
        );
*/
        parent::report($exception);
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
