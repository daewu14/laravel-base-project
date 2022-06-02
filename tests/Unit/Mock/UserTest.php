<?php

namespace Tests\Unit\Mock;

use App\Http\Repository\User\AllRepository;
use App\Models\User;
use App\Services\UserService;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_index()
    {
        Mockery::mock("overload:" . AllRepository::class)->shouldReceive('index')->andReturn('test');
        $service = new UserService();
        $result = $service->all();
        echo $result;
        self::assertTrue(true);
    }

    public function test_user_find()
    {
        Mockery::mock("overload:" . AllRepository::class)->shouldReceive('index')->andReturn('test');
        $service = new UserService();
        $result = $service->find(2);
        $this->assertEquals(2, $result->id);
    }

    public function test_user_delete()
    {
        Mockery::mock("overload:" . AllRepository::class)->shouldReceive('index')->andReturn('test');
        
        $new = User::factory()->create();
        $service = new UserService();
        $result = $service->destroy($new->id);
        $this->assertDatabaseMissing('users', ['id' => $new->id]);
    }
}
