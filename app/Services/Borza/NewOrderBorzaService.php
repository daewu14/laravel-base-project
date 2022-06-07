<?php

namespace App\Services\Borza;

use App\Base\ServiceBase;
use App\Repositories\BorzoRepository\BorzoRepository;
use App\Repositories\BorzoRepository\Models\OrderBorzoData;
use App\Repositories\BorzoRepository\OrderBorzoRepository;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Validator;

class NewOrderBorzaService extends ServiceBase
{

    public function __construct(OrderBorzoData $data)
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
            "isi" => "required",
            "berat" => "required|numeric|min:1",
            "no_pengirim" => "required|numeric|min:10",
            "no_penerima" => "required|numeric|min:10",
            "alamat_pengirim" => "required",
            "alamat_penerima" => "required",
            "nama_pengirim" => "required",
            "nama_penerima" => "required",
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

        $response = (new OrderBorzoRepository)->price($this->data);

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
            return self::error(['error' => $th]);
        }
        // return self::success("hai");
    }
}
