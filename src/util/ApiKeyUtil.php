<?php namespace XFRM\Util;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Object\Error;
use XFRM\Support\Database;

class ApiKeyUtil
{

    /**
     * @param $database Database
     * @param $apiKey string
     * @return integer the user id of the API keys owner
     */
    public static function validateApiKey(Database $database, string $apiKey): int
    {
        $userId = $database->getApiKeyOwnerId($apiKey);
        if (!is_null($userId)) {
            return $userId;
        }
        echo new Error(401, "Invalid API Key.");
        exit();
    }

}
