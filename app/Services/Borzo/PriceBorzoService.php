<?php

namespace App\Services\Borzo;

use App\Base\ServiceBase;
use App\Repositories\BorzoRepository\PriceBorzoRepository;
use App\Repositories\BorzoRepository\Models\PriceBorzoData;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Validator;

class PriceBorzoService extends ServiceBase {

    public function __construct(PriceBorzoData $data) {
        $this->data = $data;
    }

    /**
     * Validate the data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validate(): \Illuminate\Contracts\Validation\Validator {
        return Validator::make($this->data->toArray(),[
            "pengirim"     => "required",
            "penerima"     => "required",
        ]);
    }

    /**
     * main method of this service
     *
     * @return ServiceResponse
     */
    public function call(): ServiceResponse {

        if ($this->validate()->fails()) {
            return self::error(['error' => $this->validate()->errors()->all()]);
        }

        $response = (new PriceBorzoRepository)->price($this->data);
        // dd($response->data);
        if ($response->status == 200) {
            # code..
            return self::success($response->data);
        } else {
            # jika http error maka
            return self::error(null, $response->message);
        }
    }
}
