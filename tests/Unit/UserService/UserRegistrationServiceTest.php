<?php

namespace Tests\Unit\UserService;

use App\Repositories\UserRepository\Models\UserData;
use App\Repositories\UserRepository\UserRepository;
use App\Services\User\UserRegistrationService;
use Tests\TestCase;

class UserRegistrationServiceTest extends TestCase {

    // Success case of registration
    public function testUserRegistrationServiceSuccess() {

        $expect = (object) [
            "id"         => 49,
            "name"       => "Daewu",
            "email"      => "daewu@mail.com",
            "updated_at" => "2022-06-02T10:02:49.000000Z",
            "created_at" => "2022-06-02T10:02:49.000000Z"
        ];

        \Mockery::mock("overload:".UserRepository::class)->shouldReceive("register")->andReturn($expect);

        $data           = new UserData;
        $data->name     = "Daewu";
        $data->email    = "daewu@mail.com";
        $data->password = "123456";

        $service = (new UserRegistrationService($data))->call();

        // echo "\nresult : ".json_encode($service);

        self::assertTrue($service->status() == 200);
        self::assertTrue($service->data() == $expect);
        self::assertTrue($service->data()->name == $expect->name);

    }

    // Error/Failure case of registration
    public function testUserRegistrationServiceFailed() {

        $expect = (object) [
            "id"         => 49,
            "name"       => "Daewu",
            "email"      => "daewu",
            "updated_at" => "2022-06-02T10:02:49.000000Z",
            "created_at" => "2022-06-02T10:02:49.000000Z"
        ];

        \Mockery::mock("overload:".UserRepository::class)->shouldReceive("register")->andReturn($expect);

        $data           = new UserData;
        $data->name     = "Daewu";
        $data->email    = "daewu";
        $data->password = "123456";

        $service = (new UserRegistrationService($data))->call();

        // echo "\nresult : ".json_encode($service);

        self::assertTrue($service->status() != 200);

    }

}
