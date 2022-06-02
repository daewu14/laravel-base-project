<?php

namespace App\Responses;

use App\Contracts\ResponseContract;

class ServiceResponse implements ResponseContract {

    /**
     * Setter of response service
     *
     * @param $data
     * @param string $message
     * @param int $status
     */
    public function __construct($data, string $message, int $status = 200) {
        $this->status  = $status;
        $this->message = $message;
        $this->data    = $data;
    }

    public function status(): int {
        return $this->status;
    }

    public function message(): string {
        return $this->message;
    }

    public function data() {
        return $this->data;
    }
}
