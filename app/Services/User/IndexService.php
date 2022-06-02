<?php

namespace App\Services\User;

use App\Http\Repository\User\AllRepository;

class IndexService 
{
    public function index()
    {
        return (new AllRepository)->index();
    }
}