<?php

namespace App\Services\Buku;

use App\Base\ServiceBase;
use App\Repositories\BukuRepository\BukuRepository;
use App\Repositories\BukuRepository\Models\BukuData;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Validator;

class BukuService extends ServiceBase {

    public function __construct(BukuData $data) {
        $this->data = $data;
    }

    /**
     * Validate the data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validate(): \Illuminate\Contracts\Validation\Validator {
        return Validator::make($this->data->toArray(),[
            "nama"     => "required",
            "penulis"    => "required|",
            "jumlah" => "required|numeric"
        ]);
    }

    /**
     * main method of this service
     *
     * @return ServiceResponse
     */
    public function call(): ServiceResponse {

        if ($this->validate()->fails()) {
            return self::error($this->validate()->errors(), $this->validate()->errors()->first());
        }

        $dataStore = (new BukuRepository)->create($this->data);

        return self::success($dataStore, "Create success");
    }
}
