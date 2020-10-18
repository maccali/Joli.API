<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "mes_posts";
    protected $primaryKey = "postId";
    protected $fillable = [
        'title',
        'abstract',
        'text',
    ];
}
