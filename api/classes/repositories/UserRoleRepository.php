<?php
require_once(dirname(__FILE__) . '/Repository.php');
require_once(dirname(__FILE__) . '/../utils/DatabaseUtils.php');
require_once(dirname(__FILE__) . '/../model/UserRole.php');
require_once(dirname(__FILE__) . '/../model/Role.php');
require_once(dirname(__FILE__) . '/../model/User.php');
require_once(dirname(__FILE__) . '/UsersRepository.php');
require_once(dirname(__FILE__) . '/RolesRepository.php');
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 18/12/2015
 * Time: 15:23
 */
class UserRoleRepository implements Repository{
    private $dbConnProvider;
    private $userRole;
    private $usersRoles;

    /**
     * RolesRepository constructor.
     */
    public function __construct() {
        $this->dbConnProvider = new DatabaseUtils();
    }
    /**
     * @param $id
     * @return mixed
     */
    public function getElementById($id) {
        $stmt = $this->dbConnProvider->dbc->prepare("SELECT * FROM users_roles WHERE id = :id");
        $stmt->bindParam('id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $userRole=$stmt->fetchObject('UserRole');
        $stmt->closeCursor();
        return $userRole;
    }

    /**
     * This method returns all user roles by it's USER_ID
     * @param $id
     * @return mixed
     */
    public function getUserRolesByUserId($id){
        $stmt = $this->dbConnProvider->dbc->prepare("SELECT r.* FROM roles r, users_roles ur WHERE r.id = ur.roleId AND ur.userId =:userId");
        $stmt->bindParam('userId', $id, PDO::PARAM_STR);
        $stmt->execute();
        $userRoles=$stmt->fetchAll(PDO::FETCH_CLASS, 'Role');
        $stmt->closeCursor();
        return $userRoles;
    }

    /**
     * This method returns all role users by it's ROLE_ID
     * @param $id
     * @return array
     */
    public function getRoleUsersByRoleId($id) {
        $stmt = $this->dbConnProvider->dbc->prepare("SELECT u.* FROM users u, users_roles ur WHERE u.id = ur.userId AND ur.roleId =:roleId");
        $stmt->bindParam('roleId', $id, PDO::PARAM_STR);
        $stmt->execute();
        $roleUsers=$stmt->fetchAll(PDO::FETCH_CLASS, 'User');
        $stmt->closeCursor();
        return $roleUsers;
    }
    /**
     * @return mixed
     */
    public function getAllElements() {
        $stmt = $this->dbConnProvider->dbc->prepare("SELECT * FROM users_roles ORDER BY id ASC");
        $stmt->execute();
        $usersRoles=$stmt->fetchAll(PDO::FETCH_CLASS, 'UserRole');
        return $usersRoles;
    }

    /**
     * @param $object
     * @return mixed
     */
    public function saveElement($object) {
        $stmt = $this->dbConnProvider->dbc->prepare("INSERT INTO users_roles(userId,roleId,flag)  VALUES (:userId, :roleId, :flag)");
        $userId = $object->getUserId();
        $roleId = $object->getRoleId();
        $flag = $object->getFlag();
        $stmt->bindParam('userId', $userId, PDO::PARAM_STR);
        $stmt->bindParam('roleId', $roleId, PDO::PARAM_STR);
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
     * @param $object
     * @return mixed
     */
    public function updateElement($object) {
        $stmt = $this->dbConnProvider->dbc->prepare("UPDATE users_roles SET userId = :userId,roleId =:roleId,flag =:flag WHERE id=:id");
        $id = $object->getId();
        $userId = $object->getUserId();
        $roleId = $object->getRoleId();
        $flag = $object->getFlag();
        $stmt->bindParam('id', $id, PDO::PARAM_STR);
        $stmt->bindParam('userId', $userId, PDO::PARAM_STR);
        $stmt->bindParam('roleId', $roleId, PDO::PARAM_STR);
        $stmt->bindParam('flag', $flag, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteElementById($id) {
        $stmt = $this->dbConnProvider->dbc->prepare("DELETE FROM users_roles WHERE id=:id");
        $stmt->bindParam('id', $id, PDO::PARAM_STR);
        return $stmt->execute();
    }

}