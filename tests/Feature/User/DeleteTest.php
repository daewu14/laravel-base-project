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

        $id_user = User::create([
            'name' => 'Example Name',
            'email' => 'user@test' . rand(1, 99) . '.com',
            'password' => Hash::make('test124556678')
        ])->id;

        // cek route method delete
        $this->delete("/user/$id_user");
        $this->assertDatabaseMissing('users', ['id' => $id_user]);
    }
}
