<?php

namespace App\Repositories\BorzoRepository;

use App\Base\HttpService;
use App\Repositories\BorzoRepository\Models\PriceBorzoData;
use Illuminate\Support\Facades\Http;

class PriceBorzoRepository implements PriceBorzoContract {

    public function price(PriceBorzoData $data) {
        return HttpService::post()
            ->setUrl("https://robotapitest-id.borzodelivery.com/api/business/1.1/calculate-order")
            ->setServiceName("PriceBorza") // set your service inquiry's name
            ->addHeader('X-DV-Auth-Token', '3304B0D89A2F2A6DC6117902AEF51D5F1A3F861B')
            ->setData([
                "matter" => "blabla",
                "points" => [
                    [
                        "address" => $data->pengirim,
                    ],
                    [
                        "address" => $data->penerima,
                    ],
                ]
            ]) // to set your parameter
            ->call();
    }
}
