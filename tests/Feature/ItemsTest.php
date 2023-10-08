<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemsTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Item $item;
    

    protected function setUp(): void {
        parent::setUp();

        $this->user = User::factory()
            ->has(
                Item::factory()
                ->has(Tag::factory())
                )
            ->create();
    }

    public function test_create_item_successful() : void {
        $item = [
            'name' => 't-shirt',
            'description' =>'some description',            
        ];

        $response = $this->actingAs($this->user)->post('/items', $item + ['tags' => 'clothes']);

        $response->assertStatus(302);
        $this->assertDatabaseHas('items', $item);
    }

    public function test_update_item_validation_errors_redirects_back() : void {
        $item = Item::first();

        $response = $this->actingAs($this->user)
            ->put('items/' . $item->id, [
                'name' => '',
                'description' => '',
                'tags' => ''
            ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'description', 'tags']);
    }

    public function test_item_delete_successful() : void {
        $item = Item::first();

        $response = $this->actingAs($this->user)
            ->delete('items/' . $item->id);
        
        $response->assertSessionDoesntHaveErrors();
    }

    public function test_item_can_be_deleted_only_by_listing_owner() : void {
        $user = User::factory()->create();
        $item = Item::first();

        $response = $this->actingAs($user)
            ->delete('items/' . $item->id);

        $response->assertStatus(403);
    }
}
