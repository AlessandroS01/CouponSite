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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', 1);
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->string('nome', 50);
            $table->string('cognome', 50);
            $table->char('genere', 1);
            $table->integer('eta');
            $table->string('email', 50);
            $table->bigInteger('telefono');
            $table->text('via');
            $table->integer('numero_civico');
            $table->string('citta', 50);
            $table->integer('livello')->default('1');
            $table->boolean('flagCoupon')->default(false);
            $table->timestamp('email_verified_at')->nullable();

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
        Schema::dropIfExists('users');
    }
};
