<?php
require_once(dirname(__FILE__) . '/../repositories/RolesRepository.php');
require_once(dirname(__FILE__) . '/../controllers/Controller.php');
require_once(dirname(__FILE__) . '/../model/Role.php');
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 24/12/2015
 * Time: 15:43
 */
class RolesController implements Controller{
    private $rolesRepository;
    /**
     * RolesController constructor.
     */
    public function __construct() {
        $this->rolesRepository = new RolesRepository();
    }

    /**
     * Recupère un rôle utilisateur par son ID
     * @param $id
     * @return un JSON
     */
    public function getJsonObjectById($id) {
        return json_encode($this->rolesRepository->getElementById($id));
    }

    /**
     * Retourne un tableau JSON des roles
     * @return string
     */
    public function getJsonArray() {
        return json_encode($this->rolesRepository->getAllElements());
    }

    public function saveJsonObject($jsonObject) {
        $data = json_decode($jsonObject, true);
        $role = new Role();
        $role->setLibelle($data['libelle']);
        $role->setFlag($data['flag']);
        return json_encode($this->rolesRepository->saveElement($role));
    }

    public function saveJsonArray($jsonArray) {
        $error = 'Always throw this error';
        throw new Exception($error);
    }

    public function updateJsonObject($jsonObject) {
        $data = json_decode($jsonObject, true);
        $role = new Role();
        $role->setId($data['id']);
        $role->setLibelle($data['libelle']);
        $role->setFlag($data['flag']);
        return json_encode($this->rolesRepository->updateElement($role));
    }
}