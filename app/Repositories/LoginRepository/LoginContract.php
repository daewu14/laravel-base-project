<?php

namespace App\Repositories\LoginRepository;

use App\Repositories\LoginRepository\Models\LoginData;

interface LoginContract {
    // registration new user
    public function login(LoginData $data);
}
