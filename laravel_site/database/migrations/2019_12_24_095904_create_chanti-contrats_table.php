<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantiContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chanti-contrats', function (Blueprint $table) {
            $table->unsignedBigInteger('chant_id');
            $table->foreign('chant_id')
            ->references('id')
            ->on('chantiers')
            ->onDelete('restrict');
            $table->unsignedBigInteger('contrat_id');
            $table->foreign('contrat_id')
            ->references('id')
            ->on('contrats')
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
        Schema::dropIfExists('chanti-contrats');
    }
}
