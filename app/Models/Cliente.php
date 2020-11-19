<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "cliente";
    protected $primaryKey = "codigo";
    protected $fillable = [
        'cod_juridica',
        'cod_fisica',
      ];
}
