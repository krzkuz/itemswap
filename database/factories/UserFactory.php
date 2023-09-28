<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Swap;
use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'city' => fake()->city(),
            'address' => fake()->address(),
            'country' => fake()->country(),
        ];
    }

    // public function withItems($count = 1){
    //     return $this->hasItems($count);
    // }

    // public function hasItems($count = 1){
    //     return $this->has(Item::factory()->count($count), 'items');
    // }

    // public function withSentMessages($count = 1){
    //     return $this->hasSentMessages($count);
    // }

    // public function hasSentMessages($count){
    //     return $this->has(Message::factory()->count($count), 'messages');
    // }

    // public function withSwapsSent($count = 1){
    //     return $this->hasSwapsSent($count);
    // }

    // public function hasSwapsSent($count){
    //     return $this->has(Swap::factory()->count($count), 'swaps');
    // }

    // public function withSwapsReceived($count = 1){
    //     return $this->hasSwapsReceived($count);
    // }

    // public function hasSwapsReceived($count){
    //     return $this->has(Swap::factory()->count($count), 'swaps');
    // }






    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
