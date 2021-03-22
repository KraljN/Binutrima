<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MenuItem extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($menuItem){
            $menuItem->party()->delete();
        });
    }

    public function party(){
        return $this->belongsTo(Party::class);
    }
}
