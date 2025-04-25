<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('materiels_id');
            $table->unsignedInteger('typelocations_id');
            $table->float('montant');
            $table->timestamps();

            $table->foreign('materiels_id')
            ->references('id')
            ->on('materiels')
            ->onDelete('cascade');

            $table->foreign('typelocations_id')
            ->references('id')
            ->on('typelocations')
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
        Schema::dropIfExists('tarifs');
    }
}
