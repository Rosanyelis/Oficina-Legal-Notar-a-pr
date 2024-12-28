<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medio_contactos_id')->references('id')->on('medio_contactos');
            $table->string('firstname');
            $table->string('second_name')->nullable();
            $table->string('lastname');
            $table->string('second_surname')->nullable();
            $table->date('birthdate');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('calle_circuito')->nullable();
            $table->string('numero')->nullable();
            $table->string('interior_letra')->nullable();
            $table->string('interior_numero')->nullable();
            $table->string('colonia')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
