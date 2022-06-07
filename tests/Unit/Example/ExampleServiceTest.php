<?php

namespace Tests\Unit\Example;

use App\Services\ExampleService\ExampleService;
use Tests\TestCase;

class ExampleServiceTest extends TestCase {

    protected function setUp(): void {
        parent::setUp();
        (new ExampleRepositoryTest)->initSetUp();
    }

    public function testExampleService() {
        $service = (new ExampleService)->call();

        echo "\nresult : ".json_encode($service);

        self::assertTrue($service->status() == 200);
    }

}
