<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserImage extends Model
{
    use SoftDeletes;

    public function image(){
        return $this->belongsTo(Image::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
