<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','job_type','phone','phone_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function senderMessage(){
        return $this->belongsTo("App\Message","sender_id","id");
    }
    public function receiverMessage(){
        return $this->hasMany("App\Message","receiverer_id","id");
    }
}
