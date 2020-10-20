<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = "pessoas";
    protected $primaryKey = "pessoaId";
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
