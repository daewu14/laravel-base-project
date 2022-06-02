<?php

namespace App\Services;

use App\Http\Repository\User\AllRepository;
use App\Http\Repository\User\CreateRepository;
use App\Http\Repository\User\DestroyRepository;
use App\Http\Repository\User\FindRepository;
use App\Services\User\IndexService;

class UserService 
{
    public function all()
    {
        return (new IndexService)->index();
    }

    public function buat($request)
    {
        return (new CreateRepository)->index($request);
    }

    public function find($id)
    {
        return (new FindRepository)->index($id);
    }

    public function destroy($id)
    {
        return (new DestroyRepository)->index($id);
    }
}