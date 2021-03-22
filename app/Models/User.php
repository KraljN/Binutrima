<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use SoftDeletes;

    protected static function boot() {
        parent::boot();

        static::deleted(function ($user) {
            $user->posts()->delete();
            $user->userImage()->delete();
            $user->comments()->delete();
            $user->commentRatings()->delete();
            $user->postRatings()->delete();
        });
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function userImage(){
        return $this->hasOne(UserImage::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function commentRatings(){
        return $this->hasMany(CommentRating::class);
    }
    public function postRatings(){
        return $this->hasMany(PostRating::class);
    }
}
