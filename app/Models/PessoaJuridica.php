<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    protected $table = "juridicas";
    protected $primaryKey = "juridicaId";
    protected $fillable = [
        'cnpj',
        'abertura',
        'naturezaJuridica',
        'cnae',
      ];
}
