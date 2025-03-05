<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_user(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'password' => 'admin',
        ]);
        $response = $this->postJson('/api/login', [
            'username' => 'admin',
            'password' => 'admin',
        ]);
      
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['token']);

    }
}
