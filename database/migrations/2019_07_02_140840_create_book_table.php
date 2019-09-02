<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{

    public function up()
    {
       Schema::create('book',function(Blueprint $table){
           $table->increments('id');
           $table->string('title');
           $table->string('description');
           $table->string('cover');
           $table->string('book_link');
           $table->integer('publisher_id')->unsigned();
           $table->integer('category_id')->unsigned();
           $table->string('status');
           $table->foreign('publisher_id')->references('id')->on('users')->onDelete('cascade');
           $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');

           $table->timestamps();
       });
    }


    public function down()
    {
        Schema::dropIfExists('book');
    }
}
