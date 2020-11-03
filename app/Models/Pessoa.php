<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = "pessoa";
    protected $primaryKey = "codigo";
    protected $fillable = [
        'nome',
        'email',
        'endereco',
        'telefone',
        'cep',
        'cidade',
        'uf',
      ];
}
