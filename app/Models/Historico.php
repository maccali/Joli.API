<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historicos extends Model
{
    protected $table = "historicos";
    protected $primaryKey = "historicoId";
    protected $fillable = [
        'fase',
        'data',
      ];
}
