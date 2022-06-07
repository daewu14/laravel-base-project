<?php

namespace App\Repositories\BorzoRepository;

use App\Repositories\BorzoRepository\Models\PriceBorzoData;

interface PriceBorzoContract {
    // Price By Borzo
    public function price(PriceBorzoData $data);
    // public function order(PriceBorzoData $data);
}
