<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = "funcionario";
    protected $primaryKey = "codigo";
    protected $fillable = [
        'cargo',
        'data_contrato',
        'senha',
        'cod_fisica',
      ];
}
