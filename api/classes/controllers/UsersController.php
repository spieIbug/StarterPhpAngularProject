<?php
include_once(dirname(__FILE__) . '/../repositories/UsersRepository.php');
include_once(dirname(__FILE__) . '/../controllers/Service.php');
include_once(dirname(__FILE__) . '/../model/User.php');
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 16/12/2015
 * Time: 15:57
 */
class UsersController implements Service{
    private $usersRepository;
    /**
     * UsersController constructor.
     */
    public function __construct() {
        $this->usersRepository = new UsersRepository();
    }

    /**
     * return a user serialized as json by id
     * @param $id
     * @return mixed
     */
    public function getJsonObjectById($id) {
        return json_encode($this->usersRepository->getElementById($id));
    }

    /**
     * @return users Array serialized as JSON
     */
    public function getJsonArray() {
        return json_encode($this->usersRepository->getAllElements());
    }

    /**
     * @param $jsonObject
     * @return mixed
     */
    public function saveJsonObject($jsonObject) {
        // TODO: Implement saveJsonObject() method.
    }

    /**
     * @param $jsonArray
     * @return mixed
     */
    public function saveJsonArray($jsonArray) {
        // TODO: Implement saveJsonArray() method.
    }

}