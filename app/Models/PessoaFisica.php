<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    protected $table = "fisicas";
    protected $primaryKey = "fisicaId";
    protected $fillable = [
        'cpf',
        'rg',
        'nascimento',
      ];
}
