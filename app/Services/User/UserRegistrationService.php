<?php

namespace App\Services\User;

use App\Base\ServiceBase;
use App\Repositories\UserRepository\Models\UserData;
use App\Repositories\UserRepository\UserRepository;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Validator;

class UserRegistrationService extends ServiceBase {

    public function __construct(UserData $data) {
        $this->data = $data;
    }

    /**
     * Validate the data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validate(): \Illuminate\Contracts\Validation\Validator {
        return Validator::make($this->data->toArray(),[
            "name"     => "required",
            "email"    => "required|email",
            "password" => "required|min:6"
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

        $dataStore = (new UserRepository)->register($this->data);

        return self::success($dataStore, "Registration success");
    }
}
