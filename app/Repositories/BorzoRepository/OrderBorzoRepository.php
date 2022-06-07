<?php

namespace App\Repositories\BorzoRepository;

use App\Repositories\BorzoRepository\Models\OrderBorzoData;
use App\Repositories\BorzoRepository\Models\PriceBorzoData;
use Illuminate\Support\Facades\Http;

class OrderBorzoRepository implements OrderBorzoContract {

    public function price(OrderBorzoData $data) {
        $typenya = 8;
        if ($data->berat <= 5) {
            # code...
            $typenya = 8;
        } elseif ($data->berat > 11) {
            $typenya = 1;
        } else {
            # code...
            $typenya = 2;
        }


        return Http::withHeaders([
            'X-DV-Auth-Token' => '3304B0D89A2F2A6DC6117902AEF51D5F1A3F861B'
        ])->post('https://robotapitest-id.borzodelivery.com/api/business/1.1/create-order', [
            // this parameter
            'matter' => $data->isi,
            'total_weight_kg' => $data->berat,
            'vehicle_type_id' => $typenya,

            // this alamat pengirim dan penerima
            'points' => [
                [
                    'address' => $data->alamat_pengirim,
                    'contact_person' => [
                        'name' => $data->nama_pengirim,
                        'phone' => $data->no_pengirim,
                    ],
                ],
                [
                    'address' => $data->alamat_penerima,
                    'contact_person' => [
                        'name' => $data->nama_penerima,
                        'phone' => $data->no_penerima,
                    ],
                ],
            ],
        ])->json();
    }
}
