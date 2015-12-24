<?php
/**
 * Created by PhpStorm.
 * Classe model des utilisateurs de l'application
 * User: yacmed
 * Date: 16/12/2015
 * Time: 10:36
 */
class User implements \JsonSerializable{
    private $id;
    private  $login;
    private $pwd;
    private $flag;

    /**
     * User constructor.
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
    public function getLogin() {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login) {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPwd() {
        return $this->pwd;
    }

    /**
     * @param mixed $pwd
     */
    public function setPwd($pwd) {
        $this->pwd = $pwd;
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