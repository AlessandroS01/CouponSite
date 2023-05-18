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
        Schema::create('associazione', function (Blueprint $table) {
            $table->unsignedBigInteger('offerta');
            $table->unsignedBigInteger('pacchetto');

            $table->primary(['offerta', 'pacchetto']);

            $table->foreign('offerta')
                ->references('codice')
                ->on('offerta')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('pacchetto')
                ->references('codice')
                ->on('pacchetto')
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
        Schema::dropIfExists('associazione');
    }
};
