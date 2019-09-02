<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='post';
    protected $fillable=['user_id','content'];

    public function comments(){
        return $this->hasMany('App\Comment','id');
    }

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
}
