<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookComment extends Model
{
    protected $table='book_comment';
    protected $fillable=['user_id','book_id','content'];

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function book(){
        return $this->hasOne('App\Book','id','book_id');
    }
}
