<?php

namespace App\Base;

use App\Contracts\ServiceContract;
use App\Responses\ServiceResponse;

abstract class ServiceBase implements ServiceContract {

    /**
     * To return success response of the service
     *
     * @param $data
     * @param string $message
     * @return ServiceResponse
     */
    protected static function success($data, string $message = "success"): ServiceResponse {
        return new ServiceResponse($data, $message, 200);
    }

    /**
     * To return error response of the service
     *
     * @param $data
     * @param string $message
     * @param int $status
     * @return ServiceResponse
     */
    protected static function error($data, string $message = "error", int $status = 300): ServiceResponse {
        return new ServiceResponse($data, $message, $status);
    }

}
