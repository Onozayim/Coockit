<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('ingredient', 50);
            $table->unsignedSmallInteger('quantity');
            $table->string('measurement', 10);

            $table->unsignedBigInteger('receta_id');
        });

        Schema::table('ingredientes', function (Blueprint $table) {
            $table->foreign('receta_id')->references('id')->on('recetas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredientes', function(Blueprint $table) {
            $table->dropForeign('receta_id');
        });

        Schema::dropIfExists('ingredientes');
    }
}
