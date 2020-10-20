<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $primaryKey = "clienteId";
    protected $fillable = [
        'juridicaId',
        'fisicaId',
      ];
}
