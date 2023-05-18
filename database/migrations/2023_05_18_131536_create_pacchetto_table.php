<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacchetto', function (Blueprint $table) {
            $table->bigIncrements('codice');
            $table->integer('sconto_ulteriore');
            $table->string('staff', 50);

            $table->foreign('staff')
                ->references('username')
                ->on('utente')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacchetto');
    }
};
