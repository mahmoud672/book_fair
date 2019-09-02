<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReaderBookDownloadTable extends Migration
{

    public function up()
    {
        Schema::create('reader_book_download',function(Blueprint $table){
            $table->integer('book_id')->unsigned();
            $table->integer('reader_id')->unsigned();
            $table->string('downloading_times');

            $table->foreign('book_id')->references('id')->on('book')->onDelete('cascade');
            $table->foreign('reader_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['book_id','reader_id']);

            $table->timestamps();
        });
    }


    public function down()
    {
       Schema::dropIfExists('reader_book_download');
    }
}