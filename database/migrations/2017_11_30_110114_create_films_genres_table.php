<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films_genres', function (Blueprint $table) {
            $table->unsignedInteger('film_id');
            $table->unsignedInteger('genre_id');
            $table->foreign('film_id')
                ->references('id')
                ->on('films');
            $table->foreign('genre_id')
                ->references('id')
                ->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('films_genres', function (Blueprint $table) {
            $table->dropForeign(['film_id']);
            $table->dropForeign(['genre_id']);
        });
        Schema::dropIfExists('films_genres');
        Schema::enableForeignKeyConstraints();
    }
}
