<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(); 
        // cek route method delete
        $this->delete("/user/$user->id");
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
