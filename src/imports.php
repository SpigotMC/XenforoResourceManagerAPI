<?php namespace XFRM;
defined('_XFRM_API') or exit('No direct script access allowed here.');

// this file imports all the files in the project so we can use them

require_once(__DIR__ . '/object/JsonResponse.php');
require_once(__DIR__ . '/object/Author.php');
require_once(__DIR__ . '/object/Error.php');
require_once(__DIR__ . '/object/Resource.php');
require_once(__DIR__ . '/object/ResourceCategory.php');
require_once(__DIR__ . '/object/ResourceUpdate.php');
require_once(__DIR__ . '/object/PaginationInfo.php');

require_once(__DIR__ . '/support/Config.php');
require_once(__DIR__ . '/support/Database.php');
require_once(__DIR__ . '/support/Router.php');

require_once(__DIR__ . '/util/IconUtil.php');
require_once(__DIR__ . '/util/RequestUtil.php');

require_once(__DIR__ . '/controller/AuthorController.php');
require_once(__DIR__ . '/controller/ResourceController.php');
require_once(__DIR__ . '/controller/ResourceCategoryController.php');
require_once(__DIR__ . '/controller/ResourceUpdateController.php');

require_once('API.php');