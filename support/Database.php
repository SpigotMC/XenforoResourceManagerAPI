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
            $resStmt = $this->conn->prepare($this->_resource('r.resource_id = :resource_id LIMIT 1'));
            $resStmt->bindParam(':resource_id', $resource_id);

            if ($resStmt->execute()) {
                $resource = $resStmt->fetch();
                $resource['fields'] = $this->_resource_fields($resource['resource_id']);
                return $resource;
            }
        }

        return NULL;
    }

    public function getResourcesByUser($user_id) {
        if (!is_null($this->conn)) {
            $resStmt = $this->conn->prepare($this->_resource('r.user_id = :user_id'));
            $resStmt->bindParam(':user_id', $user_id);

            if ($resStmt->execute()) {
                $resources = $resStmt->fetchAll();
                
                foreach ($resources as $resource) {
                    $resource['fields'] = $this->_resource_fields($resource['resource_id']);
                }

                return $resources;
            }
        }

        return NULL;
    }

    public function getUser($user_id) {
        if (!is_null($this->conn)) {
            $userStmt = $this->conn->prepare(
                "SELECT u.user_id, u.username, u.resource_count, u.avatar_date, u.gravatar, up.allow_view_identities
                FROM xf_user u
                    INNER JOIN xf_user_privacy up
                        ON up.user_id = u.user_id
                WHERE u.user_id = :user_id
                GROUP BY u.user_id"
            );
            $userStmt->bindParam(':user_id', $user_id);

            $identStmt = $this->conn->prepare(
                "SELECT ufv.field_id, ufv.field_value
                FROM xf_user_field_value ufv
                    INNER JOIN xf_user u
                        ON u.user_id = ufv.user_id
                    INNER JOIN xf_user_field uf
                        ON uf.field_id = ufv.field_id AND uf.display_group = 'contact'
                WHERE ufv.user_id = :user_id AND ufv.field_value IS NOT NULL AND ufv.field_value != ''"
            );
            $identStmt->bindParam(':user_id', $user_id);

            if ($userStmt->execute() && $identStmt->execute()) {
                $out = new \stdClass();
                $out->user = $userStmt->fetch();
                $out->ident = $identStmt->fetchAll();
                return $out;
            }
        }

        return NULL;
    }

    private function _resource($suffix) {
        return sprintf(
            "SELECT r.resource_id, r.title, r.tag_line, r.user_id, r.username, r.price, r.currency, r.download_count, r.update_count, r.review_count, r.rating_avg, rv.version_string, ru.message
            FROM xf_resource r
                INNER JOIN xf_resource_version rv 
                    ON r.current_version_id = rv.resource_version_id 
                INNER JOIN xf_resource_update ru
                    ON r.description_update_id = ru.resource_update_id
            WHERE r.resource_state = 'visible' AND %s",
            $suffix
        );
    }

    private function _resource_fields($resource_id) {
        if (!is_null($this->conn)) {
            $fieldsStmt = $this->conn->prepare(
                "SELECT rfv.field_id, rfv.field_value as actual_field_value, rf.field_choices as possible_field_values
                FROM xf_resource_field_value rfv
                    INNER JOIN xf_resource_field rf
                        ON rf.field_id = rfv.field_id
                WHERE rfv.resource_id = :resource_id"
            );
            $fieldsStmt->bindParam(':resource_id', $resource_id);

            if ($fieldsStmt->execute()) {
                $fields = $fieldsStmt->fetchAll();
                if (!is_null($fields) && $fields !== false) {
                    return $fields;
                }
            }
        }

        return NULL;
    }
}