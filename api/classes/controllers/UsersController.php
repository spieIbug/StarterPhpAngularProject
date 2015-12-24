<?php
require_once(dirname(__FILE__) . '/../repositories/UsersRepository.php');
require_once(dirname(__FILE__) . '/../controllers/Controller.php');
require_once(dirname(__FILE__) . '/../model/User.php');
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 16/12/2015
 * Time: 15:57
 */
class UsersController implements Controller{
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
     * @param $jsonData
     * @return string
     */
    public function checkLogin($jsonData) {
        $userData = json_decode($jsonData, true);
        return json_encode($this->usersRepository->isLoginOk($userData['login'],$userData['pwd']));
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
        $data = json_decode($jsonObject, true);
        $user = new User();
        $user->setLogin($data['login']);
        $user->setPwd($data['pwd']);
        $user->setFlag($data['flag']);
        return json_encode($this->usersRepository->saveElement($user));
    }

    /**
     * @param $jsonArray
     * @throws Exception
     */
    public function saveJsonArray($jsonArray) {
        $error = 'Always throw this error';
        throw new Exception($error);
    }

    /**
     * @param $jsonObject
     * @return mixed
     */
    public function updateJsonObject($jsonObject) {
        $data = json_decode($jsonObject, true);
        $user = new User();
        $user->setId($data['id']);
        $user->setLogin($data['login']);
        $user->setPwd($data['pwd']);
        $user->setFlag($data['flag']);
        return json_encode($this->usersRepository->updateElement($user));
    }
}