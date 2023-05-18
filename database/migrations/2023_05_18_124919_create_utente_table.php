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
        Schema::create('utente', function (Blueprint $table) {
            $table->string('username', 50)->primary();
            $table->string('password', 50);
            $table->string('nome', 50);
            $table->string('cognome', 50);
            $table->char('genere', 1);
            $table->integer('eta');
            $table->string('email', 50);
            $table->bigInteger('telefono');
            $table->text('via');
            $table->integer('numero_civico');
            $table->string('citta', 50);
            $table->integer('livello');
            $table->rememberToken();
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
        Schema::dropIfExists('utente');
    }
};
