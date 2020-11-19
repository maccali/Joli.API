<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    protected $table = "juridica";
    protected $primaryKey = "cod_pessoa";
    protected $fillable = [
        'cnpj',
        'cnae',
        'abertura',
        'naturezaJuridica',
      ];
}
