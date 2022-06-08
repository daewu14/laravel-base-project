<?php

namespace App\Services\Borza;

use App\Http\Repository\User\AllRepository;
use Illuminate\Support\Facades\Http;

class BorzaHttpService 
{
    public function call()
    {
        $response = Http::withHeaders([
            'X-DV-Auth-Token' => '3304B0D89A2F2A6DC6117902AEF51D5F1A3F861B'
        ])->get('https://robotapitest-id.borzodelivery.com/api/business/1.1')->json();
        
        if ($response['is_successful'] == true) {
            # call function succes 
            return $this->success();
        } else {
            # call function error
            return $this->error();
        }
        
    }

    public function success()
    {
        return true;
    }

    public function error()
    {
        return false;
    }
}