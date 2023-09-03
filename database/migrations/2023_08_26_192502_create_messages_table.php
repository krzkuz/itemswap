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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('body');
            $table->timestamps();

            $table->foreignId('item_id')
                ->nullable()
                ->constrained('items', 'id')
                ->onDelete('set null');
            $table->foreignId('sender_id')
                ->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->foreignId('recipient_id')
                ->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
