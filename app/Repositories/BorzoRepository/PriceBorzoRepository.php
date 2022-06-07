<?php

namespace App\Repositories\BorzoRepository;

use App\Repositories\BorzoRepository\Models\PriceBorzoData;
use Illuminate\Support\Facades\Http;

class PriceBorzoRepository implements PriceBorzoContract {

    public function price(PriceBorzoData $data) {
        return Http::withHeaders([
            'X-DV-Auth-Token' => '3304B0D89A2F2A6DC6117902AEF51D5F1A3F861B'
        ])->post('https://robotapitest-id.borzodelivery.com/api/business/1.1/calculate-order', [
            'matter' => 'Documents',
            // 'coba' => 'asas',
            'points' => [
                [
                    'address' => $data->pengirim,
                ],
                [
                    'address' => $data->penerima,
                ],
            ],
        ])->json();
    }


    
}
