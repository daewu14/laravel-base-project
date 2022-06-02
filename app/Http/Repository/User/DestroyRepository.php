<?php

namespace App\Http\Repository\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DestroyRepository
{
    public function index($id)
    {
        return User::find($id)->delete();
    }
}
