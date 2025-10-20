<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Util\IconUtil as Icons;

class Author
{
    public $id;
    public $username;
    public $resource_count;
    public $identities;
    public $avatar;
    public $last_activity;

    public function __construct($payload)
    {
        $author = $payload->user;
        $identities = $payload->ident;

        $this->id = $author['user_id'];
        $this->username = $author['username'];
        $this->resource_count = $author['resource_count'];
        $this->avatar = Icons::getUserIcon($this->id, $author['avatar_date'], $author['gravatar']);

        if ($author['allow_view_profile'] === 'everyone' && $author['visible']) {
            $this->last_activity = $author['last_activity'];
        } else {
            $this->last_activity = null;
        }

        $this->identities = array();
        if ($author['allow_view_identities'] == 'everyone') {
            for ($idx = 0; $idx < count($identities); $idx++) {
                $this->identities[$identities[$idx][0]] = $identities[$idx][1];
            }
        }

        if (empty($this->identities)) {
            $this->identities = new \stdClass();
        }
    }
}
