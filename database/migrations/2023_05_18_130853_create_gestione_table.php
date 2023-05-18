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
        Schema::create('gestione', function (Blueprint $table) {
            $table->string('staff', 50);
            $table->string('azienda', 11);

            $table->primary(['staff', 'azienda']);

            $table->foreign('azienda')
                ->references('partita_iva')
                ->on('azienda')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('staff')
                ->references('username')
                ->on('utente')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gestione');
    }
};
