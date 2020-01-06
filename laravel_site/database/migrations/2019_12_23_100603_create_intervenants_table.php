<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('AdrMail',300);
            $table->unsignedBigInteger('adresse_id')->nullable();
            $table->foreign('adresse_id')
            ->references('id')
            ->on('adresses')
            ->onDelete('restrict');
            $table->unsignedBigInteger('CM_id')->nullable();
            $table->foreign('CM_id')
            ->references('id')
            ->on('corps_metiers')
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
        Schema::dropIfExists('intervenants');
    }
}
