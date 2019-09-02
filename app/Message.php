<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
   protected $table='message';
   protected $fillable=['sender_id','receiver_id','title','content'];

   public function sender(){
       return $this->hasOne("App\User","id","sender_id");
   }
   public function receiver(){
       return $this->hasOne("App\User","id","receiver_id");
   }
}
