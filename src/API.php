<?php namespace XFRM;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Object\Error as Error;
use XFRM\Object\JsonResponse as JsonResponse;
use XFRM\Support\Router as Router;
use XFRM\Util\RequestUtil as Req;

class API
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    function handleRequest()
    {
        header("Content-Type: application/json");
        header("Cache-Control: public, max-age=21600");


        // Check request has initial requirements (good method/parameters).
        if (!Req::requestPreflight()) {
            return;
        }

        // Route request, check response
        $response = new JsonResponse($this->router->route());
        if ($response->isHoldingNull()) {
            echo new Error(404, "Nothing was found for that request.");
            return;
        }

        // Send out data
        echo $response;
    }
}
