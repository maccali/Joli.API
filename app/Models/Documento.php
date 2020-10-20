<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = "documentos";
    protected $primaryKey = "documentoId";
    protected $fillable = [
        'documento',
        'tipo',
        'processoId',
        'upload',
      ];
}
