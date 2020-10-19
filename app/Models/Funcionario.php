<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = "funcionarios";
    protected $primaryKey = "funcionarioId";
    protected $fillable = [
        'cargo',
        'dataContrato',
        'senha',
        'fisicaId',
      ];
}
