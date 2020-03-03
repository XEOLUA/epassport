<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambulcard extends Model
{
    use \KodiComponents\Support\Upload;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'image', // or file | upload
    ];
    protected $table = 'ambulcards';
//    protected $guarded=['id'];

    protected $fillable = ['diagnosis', 'desc_ambulcard', 'image'];

    public function relshipAmbulcardsUsers()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
