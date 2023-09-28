<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory([
            'email' => 'qwerty@gmail.com',
            'password' => bcrypt('password')
            ])->create();
    }

    public function test_no_access_for_unauthenticated_user_to_swaps()
    {
        $response = $this->get('/swaps');
        $response->assertRedirect();
    }

    public function test_access_for_authenticated_user_to_swaps()
    {
        $response = $this->actingAs($this->user)->get('/swaps');
        $response->assertStatus(200);
    }

    public function test_no_access_for_unauthenticated_user_to_messages()
    {
        $response = $this->get('/messages');
        $response->assertRedirect();
    }

    public function test_login_redirects_to_home_page()
    {
        $response = $this->post('/authenticate', [
            'email' => 'qwerty@gmail.com',
            'password' => 'password'
        ]);
        $response->assertRedirect('/');
    }

    public function test_user_email()
    {
        $userEmail = $this->user->email;
        $this->assertEquals($userEmail, 'qwerty@gmail.com');
    }

}
