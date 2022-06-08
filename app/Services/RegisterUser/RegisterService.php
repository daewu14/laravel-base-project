<?php

namespace App\Services\RegisterUser;

use App\Base\ServiceBase;
use App\Repositories\RegisterRepository\Models\RegisterData;
use App\Repositories\RegisterRepository\RegisterRepository;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Validator;

class RegisterService extends ServiceBase
{

    public function __construct(RegisterData $data)
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
            "name"     => "required",
            "email"    => "required|email|unique:users",
            "password" => "required|min:6",
            "current_password" => "required|min:6|sometimes"
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
            return self::error($this->validate()->errors(), 'Error Validate Input');
        }

        $dataStore = (new RegisterRepository)->register($this->data);
        $tokenResult = $dataStore->createToken('auth')->plainTextToken;
        $data = [
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
        ];

        return self::success($data, "Registration success");
    }
}
