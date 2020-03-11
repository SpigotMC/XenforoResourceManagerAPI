<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class Resource {
    public $id;
    public $title;
    public $tag;
    public $author;
    public $premium;
    public $stats;

    public function __construct($resource) {
        $this->id = $resource['resource_id'];
        $this->title = $resource['title'];
        $this->tag = $resource['tag_line'];
        
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
            'rating' => array(
                'count' => $resource['rating_count'],
                'sum' => $resource['rating_sum'],
                'avg' => $resource['rating_avg'],
                'weighted' => $resource['rating_weighted']
            )
        );
    }
}