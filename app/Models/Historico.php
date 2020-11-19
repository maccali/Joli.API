<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historicos extends Model
{
    protected $table = "historico";
    protected $primaryKey = "codigo";
    protected $fillable = [
        'fase',
        'data',
        'cod_processo',
      ];
}
