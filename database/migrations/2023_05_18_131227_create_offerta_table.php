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
        Schema::create('offerta', function (Blueprint $table) {
            $table->bigIncrements('codice');
            $table->date('data_scadenza');
            $table->string('luogo_fruizione', 50);
            $table->string('modalita_fruizione', 50);
            $table->integer('percentuale_sconto');
            $table->double('prezzo_pieno');
            $table->string('oggetto_offerta', 50);
            $table->string('azienda', 11);
            $table->string('staff', 50);
            $table->string('categoria', 50);

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
        Schema::dropIfExists('offerta');
    }
};
