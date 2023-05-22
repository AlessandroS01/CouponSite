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
            $table->bigInteger('staff');
            $table->string('azienda', 11);

            $table->primary(['staff', 'azienda']);

            $table->foreign('azienda')
                ->references('partita_iva')
                ->on('azienda')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('staff')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('gestione');
    }
};
