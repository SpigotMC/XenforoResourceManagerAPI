<?php namespace XFRM\Support;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Support\Config as Config;

class Database {
    private $conn;

    public function __construct($username, $password, $hostname, $port, $database) {
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
    }

    public static function initializeViaConfig() {
        return new Database(
            Config::$data['MYSQL_USERNAME'],
            Config::$data['MYSQL_PASSWORD'],
            Config::$data['MYSQL_HOSTNAME'],
            Config::$data['MYSQL_PORT'],
            Config::$data['MYSQL_DATABASE']
        );
    }

    public function listResources($category, $page) {
        $page = $page == 1 ? 0 : 10 * ($page - 1);

        if (!is_null($this->conn)) {
            $categoryClause = is_null($category) ? '' : 'AND r.resource_category_id = :resource_category_id';
            
            $resStmt = $this->conn->prepare($this->_resource(sprintf('%s LIMIT 10 OFFSET :offset', $categoryClause)));
            $resStmt->bindParam(':offset', $page, \PDO::PARAM_INT);
            
            if (!empty($categoryClause)) {
                $resStmt->bindParam(':resource_category_id', $category);   
            }

            if ($resStmt->execute()) {
                $resources = $resStmt->fetchAll();

                for ($i = 0; $i < count($resources); $i++) {
                    $resource = $resources[$i];
                    $resource['fields'] = $this->_resource_fields($resource['resource_id']);
                    $resources[$i] = $resource;
                }

                return $resources;
            }
        }

        return NULL;
    }

    public function getResource($resource_id) {
        if (!is_null($this->conn)) {
            $resStmt = $this->conn->prepare($this->_resource('AND r.resource_id = :resource_id LIMIT 1'));
            $resStmt->bindParam(':resource_id', $resource_id);

            if ($resStmt->execute()) {
                $resource = $resStmt->fetch();
                if (!is_null($resource) && $resource !== false) {
                    $resource['fields'] = $this->_resource_fields($resource['resource_id']);
                    return $resource;
                }
            }
        }

        return NULL;
    }

    public function getResourcesByUser($user_id, $page) {
        $page = $page == 1 ? 0 : 10 * ($page - 1);

        if (!is_null($this->conn)) {
            $resStmt = $this->conn->prepare($this->_resource('AND r.user_id = :user_id LIMIT 10 OFFSET :offset'));
            $resStmt->bindParam(':user_id', $user_id);
            $resStmt->bindParam(':offset', $page, \PDO::PARAM_INT);

            if ($resStmt->execute()) {
                $resources = $resStmt->fetchAll();
                
                for ($i = 0; $i < count($resources); $i++) {
                    $resource = $resources[$i];
                    $resource['fields'] = $this->_resource_fields($resource['resource_id']);
                    $resources[$i] = $resource;
                }

                return $resources;
            }
        }

        return NULL;
    }

    public function listResourceCategories() {
        if (!is_null($this->conn)) {
            $catStmt = $this->conn->prepare("SELECT resource_category_id, category_title, category_description FROM xf_resource_category");

            if ($catStmt->execute()) {
                return $catStmt->fetchAll();
            }
        }

        return NULL;
    }

    public function getResourceUpdate($update_id) {
        if (!is_null($this->conn)) {
            $updateStmt = $this->conn->prepare($this->_resource_update('AND r.resource_update_id = :resource_update_id LIMIT 1'));
            $updateStmt->bindParam(':resource_update_id', $update_id);

            if ($updateStmt->execute()) {
                return $updateStmt->fetch();
            }
        }

        return NULL;
    }

    public function getResourceUpdates($resource_id, $page) {
        $page = $page == 1 ? 0 : 10 * ($page - 1);

        if (!is_null($this->conn)) {
            $updatesStmt = $this->conn->prepare($this->_resource_update('AND r.resource_id = :resource_id LIMIT 10 OFFSET :offset'));
            $updatesStmt->bindParam(':resource_id', $resource_id);
            $updatesStmt->bindParam(':offset', $page, \PDO::PARAM_INT);

            if ($updatesStmt->execute()) {
                return $updatesStmt->fetchAll();
            }
        }

        return NULL;
    }

    public function getUser($user_id) {
        if (!is_null($this->conn)) {
            $userStmt = $this->conn->prepare(
                "SELECT u.user_id, u.username, u.resource_count, u.avatar_date, u.gravatar, u.last_activity, u.visible, up.allow_view_profile, up.allow_view_identities
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
                $fetched = $userStmt->fetch();
                if (!is_null($fetched) && $fetched !== false) {
                    $out = new \stdClass();
                    $out->user = $fetched;
                    $out->ident = $identStmt->fetchAll();
                    return $out;
                }
            }
        }

        return NULL;
    }

    public function findUser($username) {
        if (!is_null($this->conn)) {
            $userIdStmt = $this->conn->prepare("SELECT user_id FROM xf_user WHERE username = :username LIMIT 1");
            $userIdStmt->bindParam(':username', $username);

            if ($userIdStmt->execute()) {
                $fetched = $userIdStmt->fetch();
                if (!is_null($fetched) && $fetched !== false) {
                    return $this->getUser($fetched['user_id']);
                }
            }
        }

        return NULL;
    }

    private function _resource($suffix) {
        return sprintf(
            "SELECT r.resource_id, r.title, r.tag_line, r.user_id, r.username, r.price, r.currency, r.download_count, r.update_count, r.rating_count, r.review_count, r.rating_avg, r.icon_date, r.resource_date, r.last_update, rv.version_string, rv.download_url, ru.message, rc.resource_category_id, rc.category_title, rc.category_description
            FROM xf_resource r
                INNER JOIN xf_resource_version rv 
                    ON r.current_version_id = rv.resource_version_id 
                INNER JOIN xf_resource_update ru
                    ON r.description_update_id = ru.resource_update_id
                INNER JOIN xf_resource_category rc
                    ON r.resource_category_id = rc.resource_category_id
            WHERE r.resource_state = 'visible' %s",
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

    private function _resource_update($suffix) {
        return sprintf(
            "SELECT r.resource_update_id, r.resource_id, rv.version_string, rv.download_count, r.title, r.message
            FROM xf_resource_update r
                INNER JOIN xf_resource_version rv ON r.resource_update_id = rv.resource_update_id
            WHERE r.message_state = 'visible' %s",
            $suffix
        );
    }
}