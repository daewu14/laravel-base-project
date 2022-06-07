<?php

namespace App\Services\ExampleService;

use App\Base\ServiceBase;
use App\Repositories\ExampleRepository\ExampleRepository;
use App\Responses\ServiceResponse;

class ExampleService extends ServiceBase {

    public function call(): ServiceResponse {

        $inquiry = (new ExampleRepository)->getInquiry();

        if ($inquiry->status() != 200) {
            return self::error(null, $inquiry->message());
        }

        return self::success($inquiry->data());
    }
}
