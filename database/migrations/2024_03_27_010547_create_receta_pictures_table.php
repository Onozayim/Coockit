<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetaPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receta_pictures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('receta_id');

            $table->string('path', 50);
            $table->string('extension', 10);
            $table->unsignedInteger('size');
        });

        Schema::table('receta_pictures', function (Blueprint $table) {
            $table->foreign('receta_id')->references('id')->on('recetas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receta_pictures', function (Blueprint $table) {
            $table->dropForeign('receta_id');
        });

        Schema::dropIfExists('receta_pictures');
    }
}
