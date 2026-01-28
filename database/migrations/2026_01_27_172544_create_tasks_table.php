<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();

            // high | medium | low
            $table->string('priority', 10)->default('medium');

            $table->boolean('is_completed')->default(false);

            $table->timestamps();

            $table->index(['user_id', 'is_completed']);
            $table->index(['user_id', 'priority']);
            $table->index(['user_id', 'due_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
