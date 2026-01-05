<?php namespace XFRM\Controller;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Object\ResourceUpdate as ResourceUpdate;
use XFRM\Util\RequestUtil as Req;

class ResourceUpdateController
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getResourceUpdate()
    {
        Req::checkIdParam();

        $update = $this->database->getResourceUpdate(Req::id());
        if (!is_null($update) && $update !== false) {
            return new ResourceUpdate($update);
        }

        return NULL;
    }

    public function getResourceUpdates()
    {
        Req::checkIdParam();

        $updates = $this->database->getResourceUpdates(Req::id(), Req::page());
        if (is_null($updates)) {
            return NULL;
        }

        $out = [];
        foreach ($updates as $update) {
            $out[] = new ResourceUpdate($update);
        }

        return $out;
    }
}
