<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetreContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metre-contrats', function (Blueprint $table) {
            $table->unsignedBigInteger('metre_id');
            $table->foreign('metre_id')
            ->references('id')
            ->on('metres')
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
        Schema::dropIfExists('metre-contrats');
    }
}
