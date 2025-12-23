<?php namespace XFRM\Controller;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Object\Error;
use XFRM\Object\Resource as Resource;
use XFRM\Object\ResourcePurchase;
use XFRM\Support\Database;
use XFRM\Util\ApiKeyUtil;
use XFRM\Util\RequestUtil as Req;

class ResourceController
{
    /**
     * @var Database
     */
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function listResources()
    {
        $out = [];

        $resources = $this->database->listResources(Req::category(), Req::page());

        if (is_null($resources)) {
            return NULL;
        }

        foreach ($resources as $resource) {
            $out[] = new Resource($resource);
        }

        return $out;
    }

    public function getResource()
    {
        if (Req::checkIdParam()) {
            $resource = $this->database->getResource(Req::id());

            if (!is_null($resource) && $resource !== false) {
                return new Resource($resource);
            }
        }

        return NULL;
    }

    public function getResourcesByAuthor()
    {
        $out = [];

        if (Req::checkIdParam()) {
            $resources = $this->database->getResourcesByUser(Req::id(), Req::page());

            if (is_null($resources)) {
                return NULL;
            }

            foreach ($resources as $resource) {
                $out[] = new Resource($resource);
            }
        }

        return $out;
    }

    public function getResourcePurchases()
    {
        $resource = $this->_getOwnedPremiumResource();
        $purchases = $this->database->getResourcePurchases($resource->resource_id, Req::page());
        if (!is_null($purchases)) {
            $out = [];
            foreach ($purchases as $purchase) {
                $out[] = new ResourcePurchase($purchase);
            }
            return $out;
        }
        return NULL;
    }

    public function getResourcePurchaseByUser()
    {
        if (!Req::checkUserIdParam()) {
            return NULL;
        }
        $resource = $this->_getOwnedPremiumResource();
        $purchase = $this->database->getResourcePurchaseByUser($resource->resource_id, Req::userId());
        if (!is_null($purchase)) {
            return new ResourcePurchase($purchase);
        }
        return NULL;
    }

    private function _getOwnedPremiumResource()
    {
        if (Req::checkIdParam() && Req::checkApiKeyParam()) {
            $apiKeyOwnerId = ApiKeyUtil::validateApiKey($this->database, Req::apiKey());
            $resource = $this->database->getResource(Req::id());
            if (is_null($resource) || $resource === false) {
                return NULL;
            }
            if (empty($resource->currency)) {
                echo new Error(400, "Not a premium resource.");
                exit();
            }
            if ($resource->user_id !== $apiKeyOwnerId) {
                echo new Error(403, "No access to requested resource.");
                exit();
            }
            return $resource;
        }
        return NULL;
    }

}
