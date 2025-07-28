<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class PaginationInfo {
    public $current_page;
    public $total_pages;
    public $items_per_page;
    public $results;
    public $total_results;

    public function __construct($current_page, $total_pages, $items_per_page, $results, $total_results) {
        $this->current_page = $current_page;
        $this->total_pages = $total_pages;
        $this->items_per_page = $items_per_page;
        $this->results = $results;
        $this->total_results = $total_results;
    }
}