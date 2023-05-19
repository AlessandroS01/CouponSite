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
        Schema::create('riscatto', function (Blueprint $table) {
            $table->string('cliente', 50);
            $table->unsignedBigInteger('pacchetto');
            $table->string('codice_coupon', 20)->unique();

            $table->primary(['pacchetto', 'cliente']);

            $table->foreign('pacchetto')
                ->references('codice')
                ->on('pacchetto')
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
        Schema::dropIfExists('riscatto');
    }
};
