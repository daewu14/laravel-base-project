<?php

namespace App\Repositories\LoginRepository;

use App\Models\User;
use App\Repositories\LoginRepository\Models\LoginData;
use Illuminate\Support\Facades\Auth;

class LoginRepository implements LoginContract
{

    public function login(LoginData $data)
    {
        if (!Auth::attempt(['email' => $data->email, 'password' => $data->password])) {
            return 300;
        }
        $data =  User::where('email', $data->email)->first();
        return $data->createToken('auth')->plainTextToken;

    }
}
