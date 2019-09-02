<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table='book';
    protected $fillable=['title','description','cover','book_link','publisher_id','category_id','status','author_name','isbn'];

    public function publisher(){
        return $this->hasOne('App\User','id','publisher_id');
    }

    public function category(){
        return $this->hasOne('App\Category','id',"category_id");
    }

    public function review(){
        return $this->hasMany('App\BookReview','book_id','id');
    }
    public function download(){
        return $this->hasMany('App\BookDownload','book_id','id');
    }
    public function rate(){
        return $this->hasMany('App\Rate','book_id','id');
    }
}
