<?php

namespace App\Services\Borza;

use App\Base\ServiceBase;

class BorzaService {

    public function status()
    {
        return (new BorzaHttpService)->call();
    }
}
