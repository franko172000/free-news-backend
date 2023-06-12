<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('test'),
        ]);
        $response = $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 'test'
        ]);
        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertArrayHasKey('token', $data);
        $this->assertNotNull($data['token']);
    }

    public function test_failed_login_attempt(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('test'),
        ]);
        $response = $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 'testing'
        ]);
        $response->assertStatus(401);
    }

    public function test_login_validations(): void
    {
        User::factory()->create([
            'password' => Hash::make('test'),
        ]);
        $response = $this->postJson(route('login'), []);
        $response->assertStatus(422);
    }

    public function test_user_can_register(): void
    {
        $userData = [
            'email' => 'test@example.com',
            'password' => 'test',
            'name' => 'John Doe'
        ];
        $response = $this->postJson(route('register'), $userData);
        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertArrayHasKey('token', $data);
        $this->assertDatabaseHas(User::class, [
            'email' => 'test@example.com',
            'name' => 'John Doe'
        ]);
    }

    public function test_user_registration_validation(): void
    {
        $userData = [
            'name' => 123
        ];
        $response = $this->postJson(route('register'), $userData);
        $response->assertStatus(422);
        $data = $response->json();
        $errorKeys = array_keys($data['error']['errors']);
        $this->assertTrue(in_array('email', $errorKeys));
        $this->assertTrue(in_array('name', $errorKeys));
        $this->assertTrue(in_array('password', $errorKeys));
    }

    public function test_user_register_with_same_email_twice(): void
    {
        $user = User::factory()->create();
        $response = $this->postJson(route('register'), [
            'email' => $user->email,
            'password' => 'test',
            'name' => 'John Doe'
        ]);
        $response->assertStatus(422);
        $data = $response->json();
        $errorKeys = array_keys($data['error']['errors']);
        $this->assertTrue(in_array('email', $errorKeys));
        $this->assertEquals("The email has already been taken.", $data['error']['errors']['email'][0]);
    }

    public function test_user_logout(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $response = $this->postJson(route('logout'));
        $response->assertStatus(200);
    }
}
