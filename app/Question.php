<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use \SleepingOwl\Admin\Traits\OrderableModel;
    protected $guarded=['id'];
    public function relshipQuestionsAnswers()
    {
        return $this->hasMany('App\Answer', 'question_id', 'id');
    }
}
