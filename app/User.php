<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

//    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'group', 'sex', 'birthday', 'address', 'year_in', 'parents', 'role', 'verify_token', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function relshipUsersAmbulcards()
    {
        return $this->hasMany('App\Ambulcard', 'user_id', 'id');
    }

    public function relshipUsersAnamnestcard()
    {
        return $this->hasMany('App\Anamnest', 'user_id', 'id');
    }

    public function relshipUsersResults()
    {
        return $this->hasMany('App\Result', 'user_id', 'id');
    }
}
