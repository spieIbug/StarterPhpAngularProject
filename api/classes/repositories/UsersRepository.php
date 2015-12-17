<?php
include_once(dirname(__FILE__) . '/Repository.php');
include_once(dirname(__FILE__) . '/../utils/DatabaseUtils.php');
include_once(dirname(__FILE__) . '/../model/User.php');
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 16/12/2015
 * Time: 10:52
 */
class UsersRepository implements Repository{
    private $dbConnProvider;
    private $user;
    private $users;
    /**
     * UsersRepository constructor.
     */
    public function __construct() {
        $this->dbConnProvider = new DatabaseUtils();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getElementById($id) {
        $stmt = $this->dbConnProvider->dbc->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user=$stmt->fetchObject('User');
        $stmt->closeCursor();
        return $user;
    }

    /**
     * @param $login
     * @param $pwd
     * @return mixed
     */
    public function isLoginOk($login, $pwd){
        $stmt = $this->dbConnProvider->dbc->prepare("SELECT * FROM users WHERE login = :login AND pwd =:pwd AND flag = 1");
        $stmt->bindParam('login', $login, PDO::PARAM_STR);
        $stmt->bindParam('pwd', $pwd, PDO::PARAM_STR);
        $stmt->execute();
        $this->user=$stmt->fetchObject('User');
        if ($this->user->getId()!=null) {
            return $this->user;
        } else return false;
    }

    /**
     * @return mixed
     */
    public function getAllElements() {
        $stmt = $this->dbConnProvider->dbc->prepare("SELECT * FROM users ORDER BY id ASC");
        $stmt->execute();
        $users=$stmt->fetchAll(PDO::FETCH_CLASS, 'User');
        return $users;
    }
    /**
     * @return mixed
     */
    public function getAllEnabledElements() {
        $stmt = $this->dbConnProvider->dbc->prepare("SELECT * FROM users WHERE flag=1 ORDER BY id ASC");
        $stmt->execute();
        $users=$stmt->fetchAll(PDO::FETCH_CLASS, 'User');
        return $users;
    }
    /**
     * @return mixed
     */
    public function getAllDisabledElements() {
        $stmt = $this->dbConnProvider->dbc->prepare("SELECT * FROM users WHERE flag=0 ORDER BY id ASC");
        $stmt->execute();
        $users=$stmt->fetchAll(PDO::FETCH_CLASS, 'User');
        return $users;
    }

    /**
     * @param $object
     * @return mixed
     */
    public function saveElement($object) {
        $stmt = $this->dbConnProvider->dbc->prepare("INSERT INTO users(login,pwd,flag)  VALUES (:login, :pwd, :flag)");
        $login = $object->getLogin();
        $pwd = $object->getPwd();
        $flag = $object->getFlag();
        $stmt->bindParam('login', $login, PDO::PARAM_STR);
        $stmt->bindParam('pwd', $pwd, PDO::PARAM_STR);
        $stmt->bindParam('flag', $flag, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * @param $arrayOfObjects
     * @return mixed
     */
    public function saveAllElements($arrayOfObjects) {
        // TODO: Implement saveAllElements() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function updateElementById($id) {
        // TODO: Implement updateElementById() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteElementById($id) {
        // TODO: Implement deleteElementById() method.
    }


}