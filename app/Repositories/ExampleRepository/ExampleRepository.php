<?php

namespace App\Repositories\ExampleRepository;

use App\Base\HttpService;

class ExampleRepository implements ExampleContract {

    public function getInquiry() {
        return HttpService::post()
            ->setUrl("https://robotapitest-id.borzodelivery.com/api/business/1.1/calculate-order")
            ->setServiceName("example") // set your service inquiry's name
            ->addHeader('X-DV-Auth-Token', '3304B0D89A2F2A6DC6117902AEF51D5F1A3F861B')
            ->setData([
                "matter" => "blabla",
                "points" => [
                    [
                        "address" => "cikarang pusat",
                    ],
                    [
                        "address" => "bandung selatan",
                    ],
                ]
            ]) // to set your parameter
            ->call();
    }
}
