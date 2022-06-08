<?php

namespace App\Services\Midtrans;

use App\Base\ServiceBase;
use App\Repositories\MidtransRepository\MidtransRepository;
use App\Repositories\MidtransRepository\Models\MidtransData;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Validator;

class MidtransService extends ServiceBase
{

    public function __construct(MidtransData $data)
    {
        $this->data = $data;
    }

    /**
     * Validate the data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validate(): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($this->data->toArray(), [
           "pengirim" => "required",
           "penerima" => "required"
        ]);
    }

    /**
     * main method of this service
     *
     * @return ServiceResponse
     */
    public function call(): ServiceResponse
    {

        if ($this->validate()->fails()) {
            return self::error(['error' => $this->validate()->errors()->all()]);
        }

        // $response = (new MidtransRepository)->pay($this->data);
        
        // if ($response->status == 200) {
        //     # code..
        //     return self::success($response->data);
        // } else {
        //     # jika http error maka
        //     return self::error(null, $response->message);
        // }
        return self::success("hai");
    }
}
