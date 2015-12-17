<?php
include_once('UsersRepository.php');
include_once('../model/User.php');
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 16/12/2015
 * Time: 11:03
 */
$userRepository = new UsersRepository();
$rsult = $userRepository->getAllDisabledElements();
$user = $rsult;
var_dump($user);
?>