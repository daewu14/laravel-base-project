<?php

namespace App\Services\Buku;

use App\Base\ServiceBase;
use App\Repositories\BukuRepository\BukuRepository;
use App\Responses\ServiceResponse;

class BukuIndexService extends ServiceBase {

    public function call(): ServiceResponse {
        $dataStore = (new BukuRepository)->index();
        return self::success($dataStore, "Get alll");
    }
}
