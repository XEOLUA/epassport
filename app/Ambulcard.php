<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambulcard extends Model
{

    protected $table = 'ambulcards';
    protected $guarded=['id'];

    public function relshipAmbulcardsUsers()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
