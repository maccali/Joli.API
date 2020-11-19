<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    protected $table = "acesso";
    protected $primaryKey = "codigo";
    protected $fillable = [
        'time',
        'ip',
        'feito',
        'cod_funcionario',
      ];
}
