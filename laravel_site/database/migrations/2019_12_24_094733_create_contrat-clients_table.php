<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrat-clients', function (Blueprint $table) {
            $table->unsignedBigInteger('contrat_id');
            $table->foreign('contrat_id')
            ->references('id')
            ->on('contrats')
            ->onDelete('restrict');
            $table->unsignedBigInteger('cli_id');
            $table->foreign('cli_id')
            ->references('id')
            ->on('clients')
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
        Schema::dropIfExists('contrat-clients');
    }
}
