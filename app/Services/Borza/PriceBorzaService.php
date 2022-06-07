<?php

namespace App\Services\Borza;

use App\Base\ServiceBase;
use App\Repositories\BorzoRepository\PriceBorzoRepository;
use App\Repositories\BorzoRepository\Models\PriceBorzoData;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Validator;

class PriceBorzaService extends ServiceBase {

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
            $data = [
                'error' => $this->validate()->errors()->all()
            ];
            return $data;
        }

        $response = (new PriceBorzoRepository)->price($this->data);

        try {
            if ($response['is_successful'] == false) {
                # jika http error maka
                return self::error(['error' => $response]);
                
            } else {
                # code..
                return self::success($response);
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }
}
