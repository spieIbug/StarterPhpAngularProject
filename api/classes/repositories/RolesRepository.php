<?php
require_once(dirname(__FILE__) . '/Repository.php');
require_once(dirname(__FILE__) . '/../utils/DatabaseUtils.php');
require_once(dirname(__FILE__) . '/../model/Role.php');
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 16/12/2015
 * Time: 12:39
 */
class RolesRepository implements Repository {
    private $dbConnProvider;
    private $role;
    private $roles;

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
        $stmt = $this->dbConnProvider->dbc->prepare("SELECT * FROM roles WHERE id = :id");
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $role=$stmt->fetchObject('Role');
        $stmt->closeCursor();
        return $role;
    }

    /**
     * @return mixed
     */
    public function getAllElements() {
        $stmt = $this->dbConnProvider->dbc->prepare("SELECT * FROM roles ORDER BY id ASC");
        $stmt->execute();
        $roles=$stmt->fetchAll(PDO::FETCH_CLASS, 'Role');
        return $roles;
    }

    /**
     * @param $object
     * @return mixed
     */
    public function saveElement($object) {
        $stmt = $this->dbConnProvider->dbc->prepare("INSERT INTO roles(libelle,flag)  VALUES (:libelle, :flag)");
        $libelle = $object->getLibelle();
        $flag = $object->getFlag();
        $stmt->bindParam('libelle', $libelle, PDO::PARAM_STR);
        $stmt->bindParam('flag', $flag, PDO::PARAM_INT);
        $stmt->execute();
        return $this->getElementById($this->dbConnProvider->dbc->lastInsertId());
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
        $stmt = $this->dbConnProvider->dbc->prepare("UPDATE roles SET libelle = :libelle,flag =:flag WHERE id=:id");
        $id = $object->getId();
        $libelle = $object->getLibelle();
        $flag = $object->getFlag();
        $stmt->bindParam('id', $id, PDO::PARAM_STR);
        $stmt->bindParam('libelle', $libelle, PDO::PARAM_STR);
        $stmt->bindParam('flag', $flag, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteElementById($id) {
        $stmt = $this->dbConnProvider->dbc->prepare("DELETE FROM roles WHERE id=:id");
        $stmt->bindParam('id', $id, PDO::PARAM_STR);
        return $stmt->execute();
    }




}