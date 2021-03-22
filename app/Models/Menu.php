<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Model
{
    use SoftDeletes;

    public function party(){
        return $this->belongsTo(Party::class);
    }
}
