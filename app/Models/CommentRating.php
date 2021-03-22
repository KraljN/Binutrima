<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentRating extends Model
{
    use SoftDeletes;

    public function comment(){
        return $this->belongsTo(Comment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
