<?php namespace XFRM;
defined('_XFRM_API') or exit('No direct script access allowed here.');

require_once(_XFRM_PATH . '/object/Author.php');
require_once(_XFRM_PATH . '/object/Error.php');
require_once(_XFRM_PATH . '/object/JsonResponse.php');
require_once(_XFRM_PATH . '/object/Resource.php');
require_once(_XFRM_PATH . '/support/Config.php');
require_once(_XFRM_PATH . '/support/Database.php');

use \XFRM\Object as Obj;
use \XFRM\Support as Support;

class API {
    private $database;

    public function __construct() {
        $this->database = new Support\XenforoDatabaseAccessor(
            Support\Config::$data['MYSQL_USERNAME'],
            Support\Config::$data['MYSQL_PASSWORD'],
            Support\Config::$data['MYSQL_HOSTNAME'],
            Support\Config::$data['MYSQL_PORT'],
            Support\Config::$data['MYSQL_DATABASE']
        );
    }

    function handleRequest() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            echo new Obj\Error(403, "This API is read-only. Use GET.");
            return;
        }

        if (!isset($_GET['action'])) {
            echo new Obj\Error(400, "Action not specified. Specify.");
            return;
        }

        $action = $_GET['action'];
        if (!in_array($action, array("getResource", "getResourcesByAuthor", "getAuthor"))) {
            echo new Obj\Error(400, "Invalid action. Valid actions: getResource, getResourcesByAuthor, getAuthor.");
            return;
        }

        if (!isset($_GET['id'])) {
            echo new Obj\Error(400, "ID not specified. Specify.");
            return;
        }

        $id = $_GET['id'];
        if (!is_numeric($id)) {
            echo new Obj\Error(400, "Invalid ID. ID must be numeric.");
            return;
        }

        $response = NULL;
        switch ($action) {
            case "getResource":
                $response = $this->getResource($id);
                break;
            case "getResourcesByAuthor":
                $response = $this->getResourcesByAuthor($id);
                break;
            case "getAuthor":
                $response = $this->getAuthor($id);
                break;
            default:
                // This should never happen...
                echo new Obj\Error(500, "Invalid action in switch. Exiting.");
                return;
        }

        // Successfully executed the query, cache whether exists or not
        header("Cache-Control: public, max-age=21600");

        $packed = new Obj\JsonResponse($response);
        if ($packed->isHoldingNull()) {
            echo new Obj\Error(404, "The requested data could not be located.");
            return;
        }

        echo $packed;
    }

    private function getResource($resource_id) {
        $resource = $this->database->getResource($resource_id);
        if (!is_null($resource) && $resource !== false) {
            return new Obj\Resource($resource);
        }

        return NULL;
    }

    private function getResourcesByAuthor($author_id) {
        $resources = $this->database->getResourcesByUser($author_id);
        if (is_null($resources)) return NULL;

        $out = array();
        foreach ($resources as $resource) {
            array_push($out, new Obj\Resource($resource));
        }

        return $out;
    }

    private function getAuthor($author_id) {
        $author = $this->database->getUser($author_id);
        if (!is_null($author) && $author !== false) {
            return new Obj\Author($author);
        }

        return NULL;
    }
}