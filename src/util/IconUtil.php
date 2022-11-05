<?php namespace XFRM\Util;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Support\Config as Config;

class IconUtil {
    public static function getResourceIcon($resource_id, $icon_date) {
        $iconUrl = '';

        if ($icon_date == 0) {
            $iconUrl = Config::$data['PUBLIC_PATH_STATIC'] . 'styles/spigot/xenresource/resource_icon.png';
        } else {
            $iconUrl = Config::$data['PUBLIC_PATH'] . sprintf('data/resource_icons/%d/%d.jpg?%d', floor($resource_id / 1000), $resource_id, $icon_date);

        }

        return $iconUrl;
    }

    public static function getUserIcon($user_id, $avatar_date, $gravatar) {
        $iconUrl = '';

        $gravatar_hash = empty($gravatar) ? '' : strtolower(md5(strtolower(trim($gravatar))));

        if (!empty($gravatar_hash)) {
            $iconUrl = sprintf('https://www.gravatar.com/avatar/%s.jpg?s=96', $gravatar_hash);
        } else {
            if ($avatar_date == 0) {
                $iconUrl = Config::$data['PUBLIC_PATH_STATIC'] . 'styles/spigot/xenforo/avatars/avatar_male_l.png';
            } else {
                $iconUrl = Config::$data['PUBLIC_PATH'] . sprintf('data/avatars/l/%d/%d.jpg?%d', floor($user_id / 1000), $user_id, $avatar_date);
            }
        }

        return $iconUrl;
    }
}