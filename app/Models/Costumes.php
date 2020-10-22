<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Costume extends Model
{
    use SoftDeletes;
    protected $table = "sec_costumes";
    protected $primaryKey = "costumeId";
    protected $fillable = [
        'name',
        'description',
    ];

}
