<?php

namespace App\Services\Borzo;

use App\Base\ServiceBase;

class BorzoService {

    public function status()
    {
        return (new BorzoHttpService)->call();
    }
}
