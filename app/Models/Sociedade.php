<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sociedade extends Model
{

    use SoftDeletes;
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
