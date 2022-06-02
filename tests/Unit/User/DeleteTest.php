<?php

namespace Tests\Unit\User;

use App\Models\User;
use App\Services\UserService;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $new = User::factory()->create();
        (new UserService)->destroy($new->id);
        $this->assertDatabaseMissing('users', ['id' => $new->id]);
    }
}
