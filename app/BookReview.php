<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BookReview extends Model
{
    protected $table='reader_book_review';
    protected $fillable=['book_id','reader_id','reading_times'];

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('book_id','=',$this->getAttribute('book_id'))
            ->where('reader_id','=',$this->getAttribute('reader_id'));
        return $query;
    }

    public function book(){
        return $this->hasOne('App\Book','book_id','id');
    }
}
