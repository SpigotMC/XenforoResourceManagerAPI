<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class Author {
    public $id;
    public $username;
    public $resource_count;
    public $identities;
    public $avatar;

    public function __construct($author) {
        $this->id = $author['user_id'];
        $this->username = $author['username'];
        $this->resource_count = $author['resource_count'];

        $this->identities = array();
        $identityKey = explode(",", $author['identity_key']);
        $identityVal = explode(",", $author['identity_val']);
        for ($idx = 0; $idx < count($identityKey) && $idx < count($identityVal); $idx++) {
            $this->identities[$identityKey[$idx]] = $identityVal[$idx];
        }

        $this->avatar = array(
            'info' => $author['avatar_date'],
            'hash' => empty($author['gravatar']) ? '' : strtolower(md5(strtolower(trim($author['gravatar']))))
        );
    }
}