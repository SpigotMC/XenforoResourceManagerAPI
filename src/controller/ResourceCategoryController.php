<?php namespace XFRM\Controller;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Object\ResourceCategory as ResourceCategory;
use XFRM\Util\RequestUtil as Req;

class ResourceCategoryController {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }
    
    public function listResourceCategories() {
        $out = [];

        $categories = $this->database->listResourceCategories();

        if (is_null($categories)) {
            return NULL;
        }

        foreach ($categories as $category) {
            $out[] = new ResourceCategory($category);
        }

        return $out;
    }
}
