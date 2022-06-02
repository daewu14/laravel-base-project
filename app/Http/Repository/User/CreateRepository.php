<?php

namespace App\Http\Repository\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateRepository
{
    public function index($request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }
}
