<?php

namespace App\Services\LoginUser;

use App\Base\ServiceBase;
use App\Repositories\LoginRepository\Models\LoginData;
use App\Repositories\LoginRepository\LoginRepository;
use App\Responses\ServiceResponse;

class LoginService extends ServiceBase
{

    public function __construct(LoginData $data)
    {
        $this->data = $data;
    }
    /**
     * main method of this service
     *
     * @return ServiceResponse
     */
    public function call(): ServiceResponse
    {
        $dataStore = (new LoginRepository)->Login($this->data);
        if ($dataStore == 300) {
            # code...
            return self::error('Invalid Token, Try Again');
        }
        $data = [
            'access_token' => $dataStore,
            'token_type' => 'Bearer',
        ];
        return self::success($data);
    }
}
