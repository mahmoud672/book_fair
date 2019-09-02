<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{

    public function up()
    {
        Schema::create('comment',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->string('content');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('post')->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
       Schema::dropIfExists("comment");
    }
}
