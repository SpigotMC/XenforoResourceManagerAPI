<?php namespace XFRM\Support;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Support\Database as Database;
use XFRM\Controller\ResourceController as ResourceController;
use XFRM\Controller\ResourceCategoryController as ResourceCategoryController;
use XFRM\Controller\ResourceUpdateController as ResourceUpdateController;
use XFRM\Controller\AuthorController as AuthorController;
use XFRM\Object\Error as Error;

class Router {
    private $actions;
    private $resourceController;
    private $resourceCategoryController;
    private $resourceUpdateController;
    private $authorController;

    public function __construct() {
        $this->actions = array(
            "listResources", 
            "getResource", 
            "getResourcesByAuthor", 
            "listResourceCategories", 
            "getResourceUpdate", 
            "getResourceUpdates", 
            "getAuthor", 
            "findAuthor"
        );

        $database = Database::initializeViaConfig();

        $this->resourceController = new ResourceController($database);
        $this->resourceCategoryController = new ResourceCategoryController($database);
        $this->resourceUpdateController = new ResourceUpdateController($database);
        $this->authorController = new AuthorController($database);
    }

    public function route() {
        $action = $_GET['action'];

        if (!in_array($action, $this->actions)) {
            $validActions = trim(implode(", ", $this->actions));
            echo new Error(400, "Invalid action. Valid actions: $validActions");
            exit();
        }
        
        return $this->$action();
    }

    private function listResources() {
        return $this->resourceController->listResources();
    }

    private function getResource() {
        return $this->resourceController->getResource();
    }

    private function getResourcesByAuthor() {
        return $this->resourceController->getResourcesByAuthor();
    }

    private function listResourceCategories() {
        return $this->resourceCategoryController->listResourceCategories();
    }

    private function getResourceUpdate() {
        return $this->resourceUpdateController->getResourceUpdate();
    }

    private function getResourceUpdates() {
        return $this->resourceUpdateController->getResourceUpdates();
    }

    private function getAuthor() {
        return $this->authorController->getAuthor();
    }

    private function findAuthor() {
        return $this->authorController->findAuthor();
    }
}
