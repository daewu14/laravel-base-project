<?php

namespace App\Repositories\ExampleRepository;

use App\Base\HttpService;

class ExampleRepository implements ExampleContract {

    public function getInquiry() {
        return HttpService::get()
            ->setUrl("https://tdev.kiriminaja.com/api/v7/member/banner")
            ->setServiceName("example") // set your service inquiry's name
            ->addHeader('Cache-Control', 'no-cache')
            ->addHeader('Content-Type', 'application/json')
            ->setData([
                "query_example" => "blabla"
            ]) // to set your parameter
            ->call();
    }
}
