<?php

namespace App\Http\Repository\Coba;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TambahRepository
{
    public function index($satu, $dua)
    {
        return $satu * $dua ;
    }
}
