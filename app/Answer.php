<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use \SleepingOwl\Admin\Traits\OrderableModel;
    protected $table = 'answers';
    protected $guarded=['id'];

}
