<?php

namespace Tests\Unit\User;

use App\Models\User;
use App\Services\CobaService;
use App\Services\UserService;
use Tests\TestCase;

class FindTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_find()
    {
        $data = (new UserService)->find(2);
        $this->assertEquals('2', $data->id);
    }
}
