<?php

namespace App\Console;

use DateTime;
use Illuminate\Support\Facades\DB;

<<<<<<< HEAD
class Apoio {

    function getIp($request) {
        $ip = $request->getClientIps();
        return $ip[0];
    }

    static function getTimestamp(){
        $date = new DateTime();
        $time = date('d-m-Y', strtotime($date->getTimestamp()));
        return $time;
    }

    function getMethod($request){
        switch($request->isMethod()){
            case 'post':
                return 'Post/Inserted';
            break;

            case 'get':
                return 'Get/Selected';
            break;

            case 'put':
                return 'Put/Updated';
            break;
            
            case 'delete':
                return 'Deleted';
            break;
            
            default:
                $time = self::getTimestamp(); 
                // insert error to DB -> error_logs
                DB::insert('insert into error_logs(time, log, error)
=======
class Apoio
{

  function getIp($request)
  {
    $ip = $request->getClientIps();
    return $ip[0];
  }

  function getTimestamp()
  {
    $date = new DateTime();
    $time = date('d-m-Y', strtotime($date->getTimestamp()));
    return $time;
  }

  function getMethod($request)
  {
    switch ($request->isMethod()) {
      case 'post':
        return 'Post/Inserted';
        break;

      case 'get':
        return 'Get/Selected';
        break;

      case 'put':
        return 'Put/Updated';
        break;

      case 'delete':
        return 'Deleted';
        break;

      default:
        $time = self::getTimestamp();
        // insert error to DB -> error_logs
        DB::insert('insert into error_logs(time, log, error)
>>>>>>> 2248a103232d91c36296ed13a04bb1ed1530576d
                            values(?, ?, ?)', [$time, $request->method(), 'Invalid request method']);
        return 'Invalid request';
        break;
    }
  }
}
