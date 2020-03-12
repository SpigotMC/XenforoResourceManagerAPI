<?php namespace XFRM\Support;
defined('_XFRM_API') or exit('No direct script access allowed here.');

class XenforoDatabaseAccessor {
    private static $resourceColumns = array('resource_id', 'title', 'tag_line', 'user_id', 'username', 'price', 'currency', 'download_count', 'update_count', 'review_count', 'rating_count', 'rating_sum', 'rating_avg', 'rating_weighted');
    private static $userColumns = array('user_id', 'username', 'resource_count', 'avatar_date', 'gravatar');

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
            $stmt = $this->conn->prepare($this->_select(XenforoDatabaseAccessor::$resourceColumns, 'resource', 'WHERE resource_id = :resource_id LIMIT 1'));
            $stmt->bindParam(':resource_id', $resource_id);
            if ($stmt->execute()) {
                return $stmt->fetch();
            }
        }

        return NULL;
    }

    public function getResourcesByUser($user_id) {
        if (!is_null($this->conn)) {
            $stmt = $this->conn->prepare($this->_select(XenforoDatabaseAccessor::$resourceColumns, 'resource', 'WHERE user_id = :user_id'));
            $stmt->bindParam(':user_id', $user_id);
            if ($stmt->execute()) {
                return $stmt->fetchAll();
            }
        }

        return NULL;
    }

    public function getUser($user_id) {
        if (!is_null($this->conn)) {
            $stmt = $this->conn->prepare($this->_select(XenforoDatabaseAccessor::$userColumns, 'user', 'WHERE user_id = :user_id LIMIT 1'));
            $stmt->bindParam(':user_id', $user_id);
            if ($stmt->execute()) {
                return $stmt->fetch();
            }
        }

        return NULL;
    }

    private function _select($what, $table, $query) {
        return sprintf('SELECT %s FROM %s%s %s', implode(",", $what), $this->prefix, $table, $query);
    }
}