<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookReaderTable extends Migration
{

    public function up()
    {
        Schema::create('book_reader',function(Blueprint $table){
            $table->increments('id');
            $table->string('author_name');
            $table->string('title');
            $table->string('description');
            $table->string('cover');
            $table->string('book_link');
            $table->integer('isbn');
            $table->integer('reader_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('status');

            $table->foreign('reader_id')->references('id')->on('user')->onDeleting('cascade');
            $table->foreign('category_id')->references('id')->on('category')->onDeleting('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('book_reader');
    }
}
