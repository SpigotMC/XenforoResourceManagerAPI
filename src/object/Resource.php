<?php namespace XFRM\Object;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use \XFRM\Util\IconUtil as Icons;

class Resource {
    public $id;
    public $title;
    public $tag;
    public $current_version;
    public $native_minecraft_version;
    public $supported_minecraft_versions;
    public $icon_link;
    public $author;
    public $premium;
    public $stats;
    public $external_download_url;
    public $description;

    public function __construct($resource) {
        $this->id = $resource['resource_id'];
        $this->title = $resource['title'];
        $this->tag = $resource['tag_line'];
        $this->current_version = $resource['version_string'];

        for ($idx = 0; $idx < count($resource['fields']); $idx++) {
            $field = $resource['fields'][$idx];

            switch ($field['field_id']) {
                case 'native_mc_version':
                    $this->native_minecraft_version = self::cleanupVersion($field['actual_field_value']);
                    break;
                case 'mc_versions':
                    $versions = array_map(
                        function($version) {
                            return self::cleanupVersion($version);
                        },
                        unserialize($field['actual_field_value'])
                    );
                    $this->supported_minecraft_versions = array_values($versions);
                    break; 
            }
        }

        $this->icon_link = Icons::getResourceIcon($this->id, $resource['icon_date']);

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
            'reviews' => array(
                'unique' => $resource['rating_count'],
                'total' => $resource['review_count']
            ),
            'rating' => $resource['rating_avg']
        );

        $this->external_download_url = $resource['download_url'];

        $this->description = $resource['message'];
    }

    private static function cleanupVersion($value) {
        if (strtolower($value) != 'legacy') {
            $value = str_replace('_', '.', $value);
        }

        return $value;
    }
}