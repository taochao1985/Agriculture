<?php

namespace App\Http\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Relation with Token and User
     */
    public function token()
    {
        return $this->hasMany('App\Token');
    }

    public function bids(){
        return $this->hasMany(Bids::class);
    }

    public function publish(Bids $bid){
        return $this->bids()->save($bid);
    }
}
