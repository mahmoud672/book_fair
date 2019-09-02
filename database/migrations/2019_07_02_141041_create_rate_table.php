<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateTable extends Migration
{
    public function up()
    {
        Schema::create('rate',function(Blueprint $table){
            $table->integer('book_id')->unsigned();
            $table->integer('reader_id')->unsigned();
            $table->string('evaluation');

            $table->foreign('book_id')->references('id')->on('book')->onDelete('cascade');
            $table->foreign('reader_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['book_id','reader_id']);

            $table->timestamps();
        });
    }


    public function down()
    {
       Schema::dropIfExists('rate');
    }
}
