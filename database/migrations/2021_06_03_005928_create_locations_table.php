<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->integer('nombre');
            $table->enum('etat',['actif','inactif'])->default('actif');
            $table->unsignedInteger('materiels_id');
            $table->unsignedBigInteger('clients_id');
            $table->timestamps();

            $table->foreign('materiels_id')
            ->references('id')
            ->on('materiels')
            ->onDelete('cascade');

            $table->foreign('clients_id')
            ->references('id')
            ->on('clients')
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
        Schema::dropIfExists('locations');
    }
}
