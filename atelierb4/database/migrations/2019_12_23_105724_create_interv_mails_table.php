<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interv_mails', function (Blueprint $table) {
            $table->unsignedBigInteger('mail_id');
            $table->foreign('mail_id')
            ->references('id')
            ->on('mails')
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
        Schema::dropIfExists('interv_mails');
    }
}
