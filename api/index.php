<?php
require_once(dirname(__FILE__) . '/classes/controllers/UsersController.php');
/**
 * This index is a router
 * Created by PhpStorm.
 * User: yacmed
 * Date: 23/12/2015
 * Time: 15:37
 */
header('Content-type: application/json; charset=UTF-8');
$method = "";
if (isset($_POST)){
    extract($_POST);
}
if (isset($_PUT)){
    extract($_PUT);
}
if (isset($_DELETE)){
    extract($_DELETE);
}
if (isset($_GET)){
    extract($_GET);
}
// Get Data from JSON Header
$jsonEntry = file_get_contents('php://input');
switch($method){
    case "getUser":{
        $userCtrl = new UsersController();
        if (isset($id)) echo $userCtrl->getJsonObjectById($id);
        break;
    }
    case "getAllUsers":{
        $userCtrl = new UsersController();
        echo $userCtrl->getJsonArray();
        break;
    }
    case "checkLogin":{
        $userCtrl = new UsersController();
        var_dump($userCtrl->checkLogin($jsonEntry));
        break;
    }
}