<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->text(),
        ];
    }

    // public function owner()
    // {
    //     return $this->belongsTo(User::class);
    // }
    
    // public function tags(){
    //     return $this->belongsToMany(Tag::class, 'item_tag', 'item_id', 'tag_id');
    // }
}
