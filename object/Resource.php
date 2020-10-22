<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class Resource {
    public $id;
    public $title;
    public $tag;
    public $current_version;
    //public $supported_minecraft_versions;
    public $author;
    public $premium;
    public $stats;
    public $description;

    public function __construct($resource) {
        $this->id = $resource['resource_id'];
        $this->title = $resource['title'];
        $this->tag = $resource['tag_line'];
        $this->current_version = $resource['version_string'];

        for ($idx = 0; $idx < count($resource['fields']); $idx++) {
            $field = $resource['fields'][$idx];
            // Need to do some fun here because yikes
        }

        $this->author = array(
            'id' => $resource['user_id'],
            'username' => $resource['username']
        );

        $this->premium = array(
            'price' => $resource['price'],
            'currency' => $resource['currency']
        );

        $this->stats = array(
            'downloads' => $resource['download_count'],
            'updates' => $resource['update_count'],
            'reviews' => $resource['review_count'],
            'rating' => $resource['rating_avg']
        );

        $this->description = $resource['message'];
    }
}