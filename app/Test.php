<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use \SleepingOwl\Admin\Traits\OrderableModel;

    protected $table = 'tests';
    public function relshipTestsQuestions()
    {
        return $this->hasMany('App\Question', 'test_id', 'id');
    }

}
