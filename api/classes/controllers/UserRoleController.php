<?php

/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 24/12/2015
 * Time: 15:58
 */
class UserRoleController implements Controller{
    private $userRoleRepository;
    /**
     * RolesController constructor.
     */
    public function __construct() {
        $this->userRoleRepository = new UserRoleRepository();
    }

    public function getJsonObjectById($id) {
        return json_encode($this->userRoleRepository->getElementById($id));
    }

    public function getJsonArray() {
        return json_encode($this->userRoleRepository->getAllElements());
    }

    public function saveJsonObject($jsonObject) {
        $data = json_decode($jsonObject, true);
        $userRole = new UserRole();
        $userRole->setRoleId($data['roleId']);
        $userRole->setUserId($data['userId']);
        $userRole->setFlag($data['flag']);
        return json_encode($this->userRoleRepository->saveElement($userRole));
    }

    public function saveJsonArray($jsonArray) {
        $error = 'Always throw this error';
        throw new Exception($error);
    }

    public function updateJsonObject($jsonObject) {
        $data = json_decode($jsonObject, true);
        $userRole = new UserRole();
        $userRole->setId($data['id']);
        $userRole->setRoleId($data['roleId']);
        $userRole->setUserId($data['userId']);
        $userRole->setFlag($data['flag']);
        return json_encode($this->userRoleRepository->updateElement($userRole));
    }
}