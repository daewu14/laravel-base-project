<?php

namespace App\Http\Repository\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FindRepository
{
    public function index($id)
    {
        return User::find($id);
    }
}
