<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected static function boot() {
        parent::boot();

        static::deleted(function ($category) {
//            $category->posts()->delete();
            $category->party()->delete();
        });
    }

    use SoftDeletes;

    public  function posts(){
        return $this->belongsToMany(Post::class);
    }
    public function party(){
        return $this->belongsTo(Party::class);
    }
}
