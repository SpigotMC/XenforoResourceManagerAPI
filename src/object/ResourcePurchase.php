<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class ResourcePurchase
{

    public $resource_id;

    public $user_id;

    public function __construct($database_entry)
    {
        // TODO: database structure
        $this->resource_id = $database_entry->resource_id;
        $this->user_id = $database_entry->user_id;
    }


}
