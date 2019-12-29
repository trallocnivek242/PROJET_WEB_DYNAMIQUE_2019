<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantiIntervsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chanti-intervs', function (Blueprint $table) {
            $table->unsignedBigInteger('chant_id');
            $table->foreign('chant_id')
            ->references('id')
            ->on('chantiers')
            ->onDelete('restrict');
            $table->unsignedBigInteger('interv_id');
            $table->foreign('interv_id')
            ->references('id')
            ->on('intervenants')
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
        Schema::dropIfExists('chanti-intervs');
    }
}
