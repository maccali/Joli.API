<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    protected $table = "processos";
    protected $primaryKey = "processoId";
    protected $fillable = [
        'clientId',
        'funcionarioId',
        'numero',
        'processoTipo',
        'abertura',
        'historicoId',
      ];
}
