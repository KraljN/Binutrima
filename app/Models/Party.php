<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Party extends Model
{
    use SoftDeletes;

    public function menus(){
        return $this->hasMany(Menu::class);
    }
    public function menuItems(){
        return $this->hasMany(MenuItem::class);
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }
}
