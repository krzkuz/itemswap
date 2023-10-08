<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConversationsTest extends TestCase
{
    use RefreshDatabase;

    private User $participant1;
    private User $participant2;
    // private Item $item;
    

    protected function setUp(): void {
        parent::setUp();

        $this->participant1 = User::factory()
            ->has(
                Item::factory()
                ->has(Tag::factory(2))
                )
            ->create();
        $this->participant2 = User::factory()->create();

    }

    public function test_conversation_created_successfuly() : void {   
        $item = Item::first();

        $response = $this->actingAs($this->participant2)
            ->get('conversation/new/' . $item->id);
        $response->assertStatus(200);

        $this->assertDatabaseCount('conversations', 1);
    }

    public function test_message_created_successfuly() : void {   
        $item = Item::first();

        $this->actingAs($this->participant2)
            ->get('conversation/new/' . $item->id);
        $conversation = Conversation::first();

        $response = $this->actingAs($this->participant2)
            ->post('messages/send/' . $conversation->id , [
                'body' => 'hello'
            ]);
        $message = Message::first();
        $response->assertStatus(302);
        $this->assertDatabaseCount('messages', 1);
        $this->assertEquals('hello', $message->body);
    }

    public function test_no_access_to_messages_for_unauthenticated_user() : void {
        $response = $this->get('messages');
        $response->assertStatus(302);
    }

    
}
