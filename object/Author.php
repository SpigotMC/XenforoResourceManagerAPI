<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class Author {
    public $id;
    public $username;
    public $resource_count;
    public $avatar;

    public function __construct($author) {
        $this->id = $author['user_id'];
        $this->username = $author['username'];
        $this->resource_count = $author['resource_count'];

        $this->avatar = array(
            'info' => $author['avatar_date'],
            'hash' => strtolower(md5(strtolower(trim($author['gravatar']))))
        );
    }
}