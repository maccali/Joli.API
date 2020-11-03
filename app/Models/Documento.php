<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = "documento";
    protected $primaryKey = "codigo";
    protected $fillable = [
        'tipo',
        'nome',
        'documento',
        'processoId',
        'upload',
        'cod_processo',
      ];
}
