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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('item_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('participant1_id')
                ->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->foreignId('participant2_id')
                ->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->unique(['item_id', 'participant1_id', 'participant2_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation');
    }
};
