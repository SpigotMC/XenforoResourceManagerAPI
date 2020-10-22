<?php namespace XFRM\Support;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class Config {
    public static $data = array(
        // XenForo database
        'MYSQL_USERNAME' => 'root',
        'MYSQL_PASSWORD' => 'root',
        'MYSQL_HOSTNAME' => 'localhost',
        'MYSQL_PORT' => 3306,
        'MYSQL_DATABASE' => 'database',

        // set PUBLIC_PATH to the root the XenForo installation, including trailing slash
        'PUBLIC_PATH' => 'https://spigotmc.org/'
    );
}