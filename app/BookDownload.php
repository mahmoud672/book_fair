<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BookDownload extends Model
{
   protected $table='reader_book_download';
   protected $fillable=['book_id','reader_id','downloading_times'];

   protected function setKeysForSaveQuery(Builder $query)
   {
       $query
           ->where('book_id','=',$this->getAttribute('book_id'))
           ->where('reader_id','=',$this->getAttribute('reader_id'));
       return $query;
   }
}
