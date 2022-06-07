<?php

namespace App\Repositories\BorzoRepository;

use App\Repositories\BorzoRepository\Models\OrderBorzoData;

interface OrderBorzoContract {
    // Price By Borzo
    public function price(OrderBorzoData $data);
}
