<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreignId('book_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('isbn');
            $table->unsignedSmallInteger('release_year');
            $table->foreignId('language_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->unsignedSmallInteger('number_of_pages');
            $table->unsignedBigInteger('number_of_copies');
            $table->timestamps();
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
