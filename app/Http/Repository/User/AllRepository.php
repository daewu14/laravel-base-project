<?php

namespace App\Http\Repository\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AllRepository
{
    public function index()
    {
        return User::all();
    }
}
