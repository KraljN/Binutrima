<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected static function boot() {
        parent::boot();

        static::deleted(function ($comment) {
            $comment->ratings()->delete();
        });
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function ratings(){
        return $this->hasMany(CommentRating::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
