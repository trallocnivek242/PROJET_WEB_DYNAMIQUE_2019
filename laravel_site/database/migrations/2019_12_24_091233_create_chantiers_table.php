<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chantiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('description',200);
            $table->unsignedBigInteger('adresse_id')->nullable();
            $table->foreign('adresse_id')
            ->references('id')
            ->on('adresses')
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
        Schema::dropIfExists('chantiers');
    }
}
