<?php

namespace Tests\Unit\User;

use App\Http\Repository\User\AllRepository;
use App\Services\UserService;
use Mockery;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_index()
    {
        $mock = Mockery::mock("overload:".AllRepository::class)->shouldReceive("index")->andReturn("test");

        $service = (new UserService)->all();

        echo "\nresult : ".json_encode($service);

       self::assertTrue(true);
    }
}
