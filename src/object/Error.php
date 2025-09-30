<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Object\JsonResponse as JsonResponse;

class Error extends JsonResponse {
    private $code;

    public function __construct($code, $message) {
        parent::__construct([
            "code" => $code,
            "message" => $message
        ]);

        $this->code = $code;
    }

    public function __toString() {
        http_response_code($this->code);
        return parent::__toString();
    }
}