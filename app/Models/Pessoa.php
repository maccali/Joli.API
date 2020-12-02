<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
  use SoftDeletes;
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

    'tipo',

    'cpf',
    'rg',
    'nascimento',

    'cnpj',
    'natureza_jur',
    'cnae',
    'abertura',
  ];
}
