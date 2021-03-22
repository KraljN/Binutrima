<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PostImage extends Model
{
    use SoftDeletes;

    public function image(){
        return $this->belongsTo(Image::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
