<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoProcessual extends Model
{
    protected $table = "documentos_processuais";
    protected $primaryKey = "documentoPrecessualId";
    protected $fillable = [
        'processo',
        'upload',
      ];
}
