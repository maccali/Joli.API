<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    protected $table = "acessos";
    protected $primaryKey = "acessoId";
    protected $fillable = [
        'time',
        'ip',
        'feito',
        'funcionarioId',
      ];
}
