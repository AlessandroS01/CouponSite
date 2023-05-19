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
        Schema::create('acquisizione', function (Blueprint $table) {
            $table->string('codice_coupon', 20)->unique();
            $table->unsignedBigInteger('offerta');
            $table->string('cliente', 50);

            $table->primary(['offerta', 'cliente']);

            $table->foreign('offerta')
                ->references('codice')
                ->on('offerta')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('cliente')
                ->references('username')
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
        Schema::dropIfExists('acquisizione');
    }
};
