<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class ResourceUpdate {
    public $id;
    public $resource_id;
    public $title;
    public $message;

    public function __construct($update) {
        $this->id = $update['resource_update_id'];
        $this->resource_id = $update['resource_id'];
        $this->title = $update['title'];
        $this->message = $update['message'];
    }
}