<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client-mails', function (Blueprint $table) {
            $table->unsignedBigInteger('mail_id');
            $table->foreign('mail_id')
            ->references('id')
            ->on('mails')
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
        Schema::dropIfExists('client-mails');
    }
}
