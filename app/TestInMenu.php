<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestInMenu extends Model
{
    protected $table = 'testinmenus';
    public function relMenu()
    {
        return $this->belongsTo('App\Menulist', 'menuitem_id', 'id');
    }
    public function relTest()
    {
        return $this->belongsTo('App\Test', 'test_id', 'id');
    }
}
