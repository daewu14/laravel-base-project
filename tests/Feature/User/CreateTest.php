<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create()
    {
        // testing create user method post
        $this->withoutExceptionHandling();
        $response = $this->post('/user', [
            'name' => 'Admin',
            'email' => 'user@test' . rand(1, 99) . '.com',
            'password' => Hash::make('test123')
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => 'Data Hass Been Added'
        ], true);
    }
}
