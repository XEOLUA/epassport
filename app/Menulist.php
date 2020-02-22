<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Menulist extends Model
{
    use \SleepingOwl\Admin\Traits\OrderableModel;
    protected $table = 'menu_lists';
    protected $fillable = ['title'];
    public function relMenuLists()
    {
        return $this->belongsTo('App\Menuses','menu_id','id');
    }

    public function getOrderField()
    {
        return 'order';
    }
}
