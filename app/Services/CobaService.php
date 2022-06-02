<?php

namespace App\Services;

use App\Services\Coba\TambahService;

class CobaService 
{
    public function index($satu, $dua)
    {
        return (new TambahService)->index($satu, $dua);
    }
}