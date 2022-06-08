<?php

namespace App\Repositories\MidtransRepository;

use App\Repositories\MidtransRepository\Models\MidtransData;

interface MidtransContract {
    // Payment By Midtrans
    public function pay(MidtransData $data);
}
