<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

require_once('JsonResponse.php');

class Error extends JsonResponse {
    private $code;

    public function __construct($code, $message) {
        parent::__construct(array(
            "code" => $code,
            "message" => $message
        ));

        $this->code = $code;
    }

    public function __toString() {
        http_response_code($this->code);
        return parent::__toString();
    }
}