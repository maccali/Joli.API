<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErroLog extends Model
{
    protected $table = "errosLogs";
    protected $primaryKey = "errosLogId";
    protected $fillable = [
        'time',
        'log',
        'error',
      ];
}
