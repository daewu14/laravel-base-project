<?php

namespace Tests\Unit\User;

use App\Services\UserService;
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
       $this->assertTrue(count((new UserService)->all()) > 1);
    }
}
