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
            $table->foreignId('materia_id')->references('id')->on('materias');
            $table->foreignId('juzgado_id')->references('id')->on('juzgados');
            $table->string('firstname');
            $table->string('second_name')->nullable();
            $table->string('lastname');
            $table->string('second_surname')->nullable();
            $table->date('birthdate');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('urbanization')->nullable();
            $table->string('number')->nullable();
            $table->string('street')->nullable();
            $table->string('village')->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();
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
