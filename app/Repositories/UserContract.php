<?php

namespace App\Repositories;

use App\Repositories\UserRepository\Models\UserData;

interface UserContract {
    // registration new user
    public function register(UserData $data);
}
