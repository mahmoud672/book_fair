<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Rate extends Model
{

    protected $table='rate';
    //protected $primaryKey = ['book_id', 'reader_id'];
    protected $fillable=['book_id','reader_id','evaluation'];
    //public $incrementing = false;

   protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('book_id', '=', $this->getAttribute('book_id'))
            ->where('reader_id', '=', $this->getAttribute('reader_id'));
        return $query;
    }


    public function book(){
        return $this->hasOne('App\Book','book_id');
    }
    public function reader(){
        return $this->hasOne('App\Reader','reader_id');
    }
}
