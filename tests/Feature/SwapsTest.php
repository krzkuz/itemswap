<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Swap;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SwapsTest extends TestCase
{
    use RefreshDatabase;

    private User $user1;
    private User $user2;
    private Swap $swap;
    // private Item $item;
    

    protected function setUp(): void{
        parent::setUp();

        $this->user1 = User::factory()
            ->has(
                Item::factory()
                ->has(Tag::factory(2))
                )
            ->create();
        $this->user2 = User::factory()
            ->has(
                Item::factory()
                ->has(Tag::factory(2))
            )->create();

        $this->swap = Swap::create([
            'owner_a' => $this->user1->id,
            'owner_b' => $this->user2->id,
            'item_a' => $this->user1->items()->first()->id,
            'item_b' => $this->user2->items()->first()->id,
        ]);

    }

    public function test_swap_created_successfuly(){
        $response = $this->actingAs($this->user1)
            ->post('swaps/', [
                'requestedItemOwner' => $this->user2->id,
                'requestedItemId' => $this->user2->items()->first()->id,
                'offeredItemId' => $this->user1->items()->first()->id
            ]);
        
        $response->assertStatus(302);
        $this->assertDatabaseCount('swaps', 2);
    }

    public function test_user_can_see_own_swaps(){
        $response = $this->actingAs($this->user1)
            ->get('swaps/');
        
        $response->assertStatus(200);

        $response->assertViewHas('swapsSent', function ($swapsSent) {
            foreach($swapsSent as $swap){
                if($swap->ownerA !== $this->user1){
                    return false;
                }
            }
            return true;
        });
    }

    public function test_user_cannot_see_swaps_not_owned_by_them(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get('swaps/');
        
        $response->assertStatus(200);

        $response->assertViewHas('swapsReceived');
        $viewData = $response->original->getData();
        $swapsReceived = $viewData['swapsReceived'];
        // Assert that $swapsReceived is an empty collection
        $this->assertEmpty($swapsReceived); 

        $response->assertViewHas('swapsSent');
        $viewData = $response->original->getData();
        $swapsSent = $viewData['swapsSent'];
        // Assert that $swapsSent is an empty collection
        $this->assertEmpty($swapsSent); 
    }
}
