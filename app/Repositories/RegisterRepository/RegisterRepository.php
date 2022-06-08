<?php

namespace App\Repositories\RegisterRepository;

use App\Models\User;
use App\Repositories\RegisterRepository\Models\RegisterData;

class RegisterRepository implements RegisterContract {

    public function register(RegisterData $data) {
        return User::create([
            "name"     => $data->name,
            "email"    => $data->email,
            "password" => $data->password,
        ]);
    }
}
