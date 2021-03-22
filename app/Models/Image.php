<?php

namespace App\Models;

use App\PostImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    public function userImage(){
        return $this->hasOne(UserImage::class);
    }
    public function postImage(){
        return $this->hasOne(PostImage::class);
    }
}
