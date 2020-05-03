<?php namespace XFRM\Support;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class XenforoDatabaseAccessor {
    private static $resourceColumns = array('resource_id', 'title', 'tag_line', 'user_id', 'username', 'price', 'currency', 'download_count', 'update_count', 'review_count', 'rating_avg');

    private $prefix;
    private $conn;

    public function __construct($username, $password, $hostname, $port, $database, $prefix) {
        try {
            $this->conn = new \PDO(
                sprintf(
                    "mysql:host=%s;port=%s;dbname=%s",
                    $hostname,
                    $port,
                    $database
                ),
                $username,
                $password,
                array(
                    \PDO::ATTR_PERSISTENT => true
                )
            );

            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
        } catch (\Exception $ignored) {
            $this->conn = NULL;
        }

        $this->prefix = $prefix;
    }

    public function getResource($resource_id) {
        if (!is_null($this->conn)) {
            $stmt = $this->conn->prepare($this->_resource('WHERE r.resource_id = :resource_id AND r.resource_state = "visible" LIMIT 1'));
            $stmt->bindParam(':resource_id', $resource_id);
            if ($stmt->execute()) {
                return $stmt->fetch();
            }
        }

        return NULL;
    }

    public function getResourcesByUser($user_id) {
        if (!is_null($this->conn)) {
            $stmt = $this->conn->prepare($this->_resource('WHERE r.user_id = :user_id AND r.resource_state = "visible'));
            $stmt->bindParam(':user_id', $user_id);
            if ($stmt->execute()) {
                return $stmt->fetchAll();
            }
        }

        return NULL;
    }

    public function getUser($user_id) {
        if (!is_null($this->conn)) {
            $stmt = $this->conn->prepare(
                "SELECT u.user_id, u.username, u.resource_count, u.avatar_date, u.gravatar, GROUP_CONCAT(uf.field_id SEPARATOR '\n') AS identity_key, GROUP_CONCAT(ufv.field_value SEPARATOR '\n') AS identity_val
                FROM xf_user u
                    LEFT JOIN xf_user_field_value ufv
                        ON ufv.user_id = u.user_id
                    LEFT JOIN xf_user_field uf
                        ON ufv.field_id = uf.field_id AND uf.display_group = 'contact'
                WHERE u.user_id = :user_id
                GROUP BY u.user_id"
            );
            $stmt->bindParam(':user_id', $user_id);
            if ($stmt->execute()) {
                return $stmt->fetch();
            }
        }

        return NULL;
    }

    private function _resource($suffix) {
        return sprintf(
            "SELECT r.resource_id, r.title, r.tag_line, r.user_id, r.username, r.price, r.currency, r.download_count, r.update_count, r.review_count, r.rating_avg, rv.version_string
            FROM xf_resource r
                INNER JOIN xf_resource_version rv 
                    ON r.current_version_id = rv.resource_version_id 
            %s",
            $suffix
        );
    }

    private function _select($what, $table, $query) {
        return sprintf('SELECT %s FROM %s%s %s', implode(",", $what), $this->prefix, $table, $query);
    }
}