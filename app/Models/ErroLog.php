<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErroLog extends Model
{
    protected $table = "erros_logs";
    protected $primaryKey = "errorLogId";
    protected $fillable = [
        'time',
        'log',
        'error',
      ];
}
