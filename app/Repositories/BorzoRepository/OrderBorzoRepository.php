<?php

namespace App\Repositories\BorzoRepository;

use App\Base\HttpService;
use App\Repositories\BorzoRepository\Models\OrderBorzoData;
use App\Repositories\BorzoRepository\Models\PriceBorzoData;
use App\Services\Borza\Config\BorzoConfig;
use Illuminate\Support\Facades\Http;

class OrderBorzoRepository implements OrderBorzoContract
{
    use BorzoConfig;

    public function price(OrderBorzoData $data)
    {
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

        return HttpService::post()
            ->setUrl("{$this->getBaseUrl()}api/business/1.1/create-order")
            ->setServiceName("NewOrderBorza") // set your service inquiry's name
            ->addHeader('X-DV-Auth-Token', $this->getApiKey())
            ->setData([
                // this parameter
                "matter" => $data->isi,
                "total_weight_kg" => $data->berat,
                "vehicle_type_id" => $typenya,

                // this alamat pengirim dan penerima
                "points" => [
                    [
                        "address" => $data->alamat_pengirim,
                        "contact_person" => [
                            "name" => $data->nama_pengirim,
                            "phone" => $data->no_pengirim,
                        ],
                    ],
                    [
                        "address" => $data->alamat_penerima,
                        "contact_person" => [
                            "name" => $data->nama_penerima,
                            "phone" => $data->no_penerima,
                        ],
                    ],
                ],
            ]) // to set your parameter
            ->call();
    }
}
