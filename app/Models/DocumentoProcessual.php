<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoProcessual extends Model
{
    protected $table = "documentos_processual";
    protected $primaryKey = "codigo";
    protected $fillable = [
        'processo',
        'upload',
        'cod_processo',
      ];
}
