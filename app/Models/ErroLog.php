<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErroLog extends Model
{
    protected $table = "erros_logs_tabela";
    protected $primaryKey = "codigo";
    protected $fillable = [
        'time',
        'log',
        'error',
      ];
}
