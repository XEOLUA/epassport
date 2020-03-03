<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'users';
    protected $guarded=['id'];
    public function relStudentAmbularcard()
    {
        return $this->hasMany('App\Ambulcard', 'user_id', 'id');
    }
    public function relStudentAnamnest()
    {
        return $this->hasMany('App\Anamnest', 'user_id', 'id');
    }
}
