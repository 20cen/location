<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockactuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockactuels', function (Blueprint $table) {
            $table->id();
            $table->integer('nombre');
            $table->unsignedInteger('materiels_id');
            $table->timestamps();

            $table->foreign('materiels_id')
            ->references('id')
            ->on('materiels')
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
        Schema::dropIfExists('stockactuels');
    }
}
