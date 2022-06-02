<?php

namespace Tests\Unit\User;

use App\Http\Repository\User\AllRepository;
use App\Services\UserService;
use Mockery;
use Tests\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class IndexTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_index()
    {
        //    $this->assertFalse(count((new UserService)->all()) == 0);
        $mock = Mockery::mock("overload:" . AllRepository::class);
        $mock->shouldReceive("index")->once();
    }
}
