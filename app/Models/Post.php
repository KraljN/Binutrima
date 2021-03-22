<?php

namespace App\Models;

use App\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes;

    protected static function boot() {
        parent::boot();

        static::deleted(function ($post) {
            $post->ratings()->delete();
            $post->comments()->delete();
            $post->postImage()->delete();
            $post->categories()->delete();// Ovo moze praviti problem ukoliko ne radi uvezano brisanje za postove i kategorije
        });
    }

    public function postImage(){
        return $this->hasOne(PostImage::class);
    }
    public  function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function ratings(){
        return $this->hasMany(PostRating::class);
    }

}
