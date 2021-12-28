<?php namespace XFRM\Util;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Object\Error as Error;

/**
 * These are navigation guards. They stop the app in its tracks if requirements
 * are not being met.
 */
class RequestUtil {
    public static function requestPreflight() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            echo new Error(403, "This API is read-only. Use GET.");
            exit();
        }

        if (!isset($_GET['action'])) {
            echo new Error(400, "Action not specified. Specify.");
            exit();
        }

        return true;
    }

    public static function id() {
        return $_GET['id'] ?? null;
    }

    public static function checkIdParam() {
        $id = self::id();

        if (is_null($id)) {
            echo new Error(400, "ID not specified. Please specify.");
            exit();
        }

        if (!is_numeric($id)) {
            echo new Error(400, "Invalid ID. ID must be numeric.");
            exit();
        }

        return true;
    }

    public static function name() {
        return $_GET['name'] ?? null;
    }

    public static function checkNameParam() {
        $name = self::name();

        if (is_null($name)) {
            echo new Error(400, "Name not specified. Please specify.");
            exit();
        }

        // regex as per https://github.com/SpigotMC/XenforoResourceManagerAPI/issues/41#issuecomment-861888191
        // slightly modified to accommodate legacy usernames
        if (!preg_match("/^[A-Za-z0-9_\.\- ]{3,24}$/", $name)) {
            echo new Error(400, "Invalid name. Name must be at 3-24 characters in length and consist of letters, numbers, and/or a limited set of special characters (_, -, ., and/or one or more spaces).");
            exit();
        }

        return true;
    }

    public static function page() {
        $value = $_GET['page'] ?? null;

        if (!is_null($value) && is_numeric($value) && $value > 0) {
            return $value;
        }

        return 1;
    }

    public static function category() {
        $value = $_GET['category'] ?? null;

        if (!is_null($value) && is_numeric($value)) {
            return $value;
        }

        return NULL;
    }
}
