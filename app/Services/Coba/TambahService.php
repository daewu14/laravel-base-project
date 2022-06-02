<?php

namespace App\Services\Coba;

use App\Http\Repository\Coba\TambahRepository;
use App\Http\Repository\User\AllRepository;

class TambahService 
{
    public function index($satu, $dua)
    {
        return (new TambahRepository)->index($satu, $dua);
    }
}