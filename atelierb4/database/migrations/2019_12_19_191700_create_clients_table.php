<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->char('phone', 10);
            $table->tinyInteger('sexe');
            $table->string('email',254)->unique();
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
        Schema::dropIfExists('clients');
    }
}
