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
        Schema::create('swaps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('is_confirmed')
                ->default(false);
            //always a user who receives an offer 
            $table->foreignId('owner_a')
                ->constrained('users', 'id')
                ->onDelete('cascade');
            $table->foreignId('item_a')
                ->constrained('items', 'id')
                ->onDelete('cascade');
            //always a user who sends an offer 
            $table->foreignId('owner_b')
                ->constrained('users', 'id')
                ->onDelete('cascade');
            $table->foreignId('item_b')
                ->constrained('items', 'id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swaps');
    }
};
