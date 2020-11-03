<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    protected $table = "fisica";
    protected $primaryKey = "cod_pessoa";
    protected $fillable = [
        'cpf',
        'rg',
        'nascimento',
      ];
}
