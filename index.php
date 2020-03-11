<?php 
define('_XFRM_API', 1);
define('_XFRM_PATH', __DIR__);

require_once('API.php');

(new XFRM\API())->handleRequest();