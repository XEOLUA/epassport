<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menuses';
    public function relshipMenus()
    {
        return $this->hasMany('App\Menulist', 'menu_id', 'id');
    }
}
