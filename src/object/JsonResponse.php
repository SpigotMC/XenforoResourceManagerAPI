<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class JsonResponse {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function __toString() {
        try {
            return json_encode($this->data) . "\n";
        } catch (\Exception $ignored) {
            return '';
        }
    }

    public function isHoldingNull() {
        return is_null($this->data);
    }
}
