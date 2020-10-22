<?php define('_XFRM_API', 1);

// import all files
require_once('imports.php');

// launch api
(new XFRM\API())->handleRequest();