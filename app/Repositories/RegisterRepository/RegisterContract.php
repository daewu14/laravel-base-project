<?php

namespace App\Repositories\RegisterRepository;

use App\Repositories\RegisterRepository\Models\RegisterData;

interface RegisterContract {
    // registration new user
    public function register(RegisterData $data);
}
