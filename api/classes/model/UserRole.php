<?php
require_once(dirname(__FILE__).'/Role.php');
require_once(dirname(__FILE__).'/User.php');
/**
 * Created by PhpStorm.
 * Classe model des roles attribués aux users
 * User: yacmed
 * Date: 16/12/2015
 * Time: 10:47
 */
class UserRole implements \JsonSerializable{
    private $id;
    //  Référence à l'utilisateur.
    private $userId;
    //  Référence au role.
    private $roleId;
    private $flag;

    /**
     * UserRole constructor.
     */
    public function __construct() {
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getRoleId() {
        return $this->roleId;
    }

    /**
     * @param mixed $roleId
     */
    public function setRoleId($roleId) {
        $this->roleId = $roleId;
    }

    /**
     * @return mixed
     */
    public function getFlag() {
        return $this->flag;
    }

    /**
     * @param mixed $flag
     */
    public function setFlag($flag) {
        $this->flag = $flag;
    }
    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}