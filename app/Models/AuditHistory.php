<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErroLog extends Model
{
    protected $table = "error_logs_tabela";
    protected $primaryKey = "codigo";
    protected $fillable = [
<<<<<<< HEAD
        'time',
        'log',
        'error',
=======
        'data',
        'status',
        'operator',
        'request',
        'response',
>>>>>>> 2248a103232d91c36296ed13a04bb1ed1530576d
      ];
}
