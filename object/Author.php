<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class Author {
    public $id;
    public $username;
    public $resource_count;
    public $identities;
    public $avatar;

    public function __construct($payload) {
        $author = $payload->user;
        $identities = $payload->ident;

        $this->id = $author['user_id'];
        $this->username = $author['username'];
        $this->resource_count = $author['resource_count'];

        $this->identities = array();
        if ($author['allow_view_identities'] == 'everyone') {
            for ($idx = 0; $idx < count($identities); $idx ++) {
                $this->identities[$identities[$idx][0]] = $identities[$idx][1];
            }
        }

        if (empty($this->identities)) {
            $this->identities = new \stdClass();
        }

        $this->avatar = array(
            'info' => $author['avatar_date'],
            'hash' => empty($author['gravatar']) ? '' : strtolower(md5(strtolower(trim($author['gravatar']))))
        );
    }
}