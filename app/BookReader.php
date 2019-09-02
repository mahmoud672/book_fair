<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookReader extends Model
{
    protected $table='book_reader';
    protected $fillable=['author_name','title','description','cover','book_link','isbn','reader_id','category_id','status'];

    public function reader(){
        return $this->hasOne('App\User','id','reader_id');
    }

    public function category(){
        return $this->hasOne('App\Category','id','category_id');
    }
}
