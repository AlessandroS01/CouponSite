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
        Schema::create('azienda', function (Blueprint $table) {
            $table->string('partita_iva', 11)->primary();
            $table->string('nome', 50);
            $table->longText('localita');
            $table->string('tipologia', 50);
            $table->string('email', 50);
            $table->string('telefono', 10);
            $table->longText('descrizione');
            $table->longText('logo');
            $table->string('ragione_sociale', 20)->nullable();
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
        Schema::dropIfExists('azienda');
    }
};
