<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Swap>
 */
class SwapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'is_confirmed' => false,
            // 'owner_a' => 

            // 'sent_messages' => $this->hasMany(Message::factory(), 'sender_id', 'id'),
            // 'swaps_sent' => $this->hasMany(Swap::factory(), 'owner_b', 'id'),
            // 'swaps_received' => $this->hasMany(Swap::factory(), 'owner_a', 'id'),
        ];
    }

    // public function ownerA(){
    //     return $this->belongsTo(User::class, 'owner_a');
    // }

    // public function ownerB(){
    //     return $this->belongsTo(User::class, 'owner_b');
    // }

    // public function itemA(){
    //     return $this->belongsTo(Item::class, 'item_a');
    // }

    // public function itemB(){
    //     return $this->belongsTo(Item::class, 'item_b');
    // }
}
