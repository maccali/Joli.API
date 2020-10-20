<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sociedade extends Model
{
    protected $table = "sec_sociedades";
    protected $primaryKey = "sociedadeId";
    protected $fillable = [
        'name',
        'description',
        'list'
    ];

    protected $casts = [
      'list' => 'array'
    ];

}
