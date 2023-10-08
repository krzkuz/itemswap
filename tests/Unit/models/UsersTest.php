<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UsersTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_created_user_should_have_id(): void
    {
        $this->assertNotEmpty($this->user->id);
    }

    public function test_search_user_by_id() : void
    {
        $userId = $this->user->id;
        $userFound = User::find($userId);
        $this->assertNotNull($userFound);
    }
}
