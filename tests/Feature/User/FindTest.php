<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class FindTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_find()
    {
        $this->withoutExceptionHandling();

        // buat user dan dapetin id
        $user_id = User::factory()->create()->id;

        // cek route method get
        $response = $this->get("/user/$user_id/edit");

        // cek tampilan apakah tersedia atau tidak
        $response->assertJson([
            'id' => $user_id
        ], true);

        // target status itu 200 ok
        $response->assertStatus(200);
    }
}
