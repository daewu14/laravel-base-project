<?php

namespace App\Repositories\UserRepository;

use App\Models\User;
use App\Repositories\UserContract;
use App\Repositories\UserRepository\Models\UserData;

class UserRepository implements UserContract {

    public function register(UserData $data) {
        return User::create([
            "name"     => $data->name,
            "email"    => $data->email,
            "password" => $data->password,
        ]);
    }
}
