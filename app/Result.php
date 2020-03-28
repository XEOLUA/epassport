<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function relshipResultsTests()
    {
        return $this->belongsTo('App\Test', 'test_id', 'id');
    }
    public function relshipResultsUsers()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
