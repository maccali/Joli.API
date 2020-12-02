<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Processo extends Model
{
  use SoftDeletes;
  protected $table = "processo";
  protected $primaryKey = "codigo";
  protected $fillable = [
    'cod_cliente',
    'cod_funcionario',
    'cod_processo',
    'numero',
    'documento',
    'documento_processual',
    'processo_tipo',
    'abertura',
  ];
}
