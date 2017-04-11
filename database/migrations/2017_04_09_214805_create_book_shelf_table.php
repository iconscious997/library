<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookShelfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_shelf', function (Blueprint $table) {
            $table->unsignedInteger('shelf_id');
            $table->unsignedInteger('book_id');
            $table->timestamps();

            $table->foreign('shelf_id')->references('id')->on('shelves');
            $table->foreign('book_id')->references('id')->on('books');

            $table->engine = 'MyISAM';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_shelf');
    }
}
