<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Costume extends Model
{
    protected $table = "sec_costumes";
    protected $primaryKey = "costumeId";
    protected $fillable = [
        'name',
        'description',
    ];

}
