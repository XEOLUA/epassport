<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'users';
    protected $guarded=['id'];
    public function relshipStudentsAmbulcards()
    {
        return $this->hasMany('App\Ambulcard', 'user_id', 'id');
    }
}
