<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantiPvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chanti-pvs', function (Blueprint $table) {
            $table->unsignedBigInteger('chant_id');
            $table->foreign('chant_id')
            ->references('id')
            ->on('chantiers')
            ->onDelete('restrict');
            $table->unsignedBigInteger('pv_id');
            $table->foreign('pv_id')
            ->references('id')
            ->on('pvs')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chanti-pvs');
    }
}
