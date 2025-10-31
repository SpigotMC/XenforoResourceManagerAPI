<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class ResourceCategory
{
    public $id;
    public $title;
    public $description;

    public function __construct($update)
    {
        $this->id = $update['resource_category_id'];
        $this->title = $update['category_title'];
        $this->description = $update['category_description'];
    }
}
