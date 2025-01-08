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
        Schema::create('board_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_space_id')->references('id')->on('work_spaces')->onDelete('cascade');
            $table->foreignId('board_id')->constrained('boards')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->date('start_date')->nullable(); // fecha de inicio
            $table->date('due_date')->nullable(); // fecha de vencimiento
            $table->time('start_time')->nullable(); // hora de inicio
            $table->time('due_time')->nullable(); // hora de vencimiento
            $table->text('description');
            $table->string('priority'); // prioridad
            $table->string('badge_text');
            $table->string('badge');
            $table->enum('event_calendar', ['Si', 'No'])->default('No');
            $table->enum('billable_task', ['Si', 'No'])->default('No');
            $table->time('time_billable_task')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_items');
    }
};
