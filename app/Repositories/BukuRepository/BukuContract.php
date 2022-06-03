<?php

namespace App\Repositories\BukuRepository;

use App\Repositories\BukuRepository\Models\BukuData;

interface BukuContract {
    // create new data
    public function create(BukuData $data);
}
