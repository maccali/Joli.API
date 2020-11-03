<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    protected $table = "processo";
    protected $primaryKey = "codigo";
    protected $fillable = [
        'cod_cliente',
        'cod_funcionario',
        'numero',
        'processo_tipo',
        'abertura',
      ];
}
