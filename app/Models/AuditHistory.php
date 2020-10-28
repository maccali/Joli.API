<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErroLog extends Model
{
    protected $table = "audit_histories";
    protected $primaryKey = "auditHistoryId";
    protected $fillable = [
        'data',
        'status',
        'user',
        'request',
        'response',
      ];
}
