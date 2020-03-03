<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anamnest extends Model
{
    protected $table = 'anamnests';
    protected $guarded=['id'];

    public function relshipAnamnestcardsUsers()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
