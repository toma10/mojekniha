<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('book_id');
            $table->string('isbn');
            $table->unsignedSmallInteger('release_year');
            $table->unsignedBigInteger('language_id');
            $table->unsignedSmallInteger('number_of_pages');
            $table->unsignedBigInteger('number_of_copies');
            $table->timestamps();

            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');

            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('editions');
    }
}
