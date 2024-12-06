<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        //simulates sending a POST request
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'role' => 'user',
        ]);

        // Assert that the registration was successful
        $response->assertStatus(201);

        // ensures that the response contains the expected JSON structure.
        $response->assertJsonStructure([
            'user' => [
                'name',
                'email',
                'role',
                'created_at',
                'updated_at',
                'id',
            ],
        ]);

        // Check that the user is actually created in the database
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
        ]);
    }
}
