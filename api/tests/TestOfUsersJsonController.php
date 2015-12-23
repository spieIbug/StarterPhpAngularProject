<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(dirname(__FILE__) . '/simpletest/mock_objects.php');
require_once(dirname(__FILE__) . '/simpletest/simpletest.php');
require_once('../classes/repositories/UsersRepository.php');
require_once('../classes/controllers/UsersController.php');
require_once('../classes/model/User.php');
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 16/12/2015
 * Time: 16:01
 */
class TestOfUsersJsonController extends UnitTestCase{
    function setUp() {
        echo "<div style='border: 2px solid;border-radius: 5px;padding: 10px;margin: 5px;'>";
    }
    function tearDown() {
        echo "</div>";
    }
    function testGetJsonObjectById1EqualAssert() {
        $userExpected =  new User();
        $userExpected->setId("1");
        $userExpected->setLogin("meyacine");
        $userExpected->setPwd("root");
        $userExpected->setFlag("1");
        $userExpected = json_encode($userExpected);
        $userController = new UsersController();
        $user = $userController->getJsonObjectById(1);
        $this->assertEqual($userExpected, $user);
    }
    function testGetJsonObjectById1NotEqualAssert() {
        $userExpected =  new User();
        $userExpected->setId("1");
        $userExpected->setLogin("myacine");
        $userExpected->setPwd("root");
        $userExpected->setFlag("1");
        $userExpected = json_encode($userExpected);
        $userController = new UsersController();
        $user = $userController->getJsonObjectById(1);
        $this->assertNotEqual($userExpected, $user);
    }
    function testShouldGetJsonArray() {
        $userTest =  new User();
        $userTest->setId("1");
        $userTest->setLogin("meyacine");
        $userTest->setPwd("root");
        $userTest->setFlag("1");
        $usersExpected[0] = $userTest;
        $userTest =  new User();
        $userTest->setId("2");
        $userTest->setLogin("ramzi");
        $userTest->setPwd("admin");
        $userTest->setFlag("1");
        $usersExpected[1] = $userTest;
        $userTest =  new User();
        $userTest->setId("3");
        $userTest->setLogin("admin");
        $userTest->setPwd("admin");
        $userTest->setFlag("1");
        $usersExpected[2] = $userTest;
        $userTest =  new User();
        $userTest->setId("5");
        $userTest->setLogin("root");
        $userTest->setPwd("root");
        $userTest->setFlag("1");
        $usersExpected[3] = $userTest;
        $usersExpected = json_encode($usersExpected);
        $userController = new UsersController();
        $users = $userController->getJsonArray();
        $this->assertEqual($usersExpected, $users);
    }
    function testShouldGetJsonArrayNotEqual() {
        $userTest =  new User();
        $userTest->setId("1");
        $userTest->setLogin("meyacine");
        $userTest->setPwd("root");
        $userTest->setFlag("1");
        $usersExpected[0] = $userTest;
        $usersExpected = json_encode($usersExpected);
        $userController = new UsersController();
        $users = $userController->getJsonArray();
        $this->assertNotEqual($usersExpected, $users);
    }
    function testSaveJsonObjectShouldSaveUser(){
        $user = new User();
        $user->setLogin("root");
        $user->setPwd("root");
        $user->setFlag("1");
        $user = json_encode($user);
        $controller = new UsersController();
        $this->assertEqual($controller->saveJsonObject($user),'false');
    }
    function testUpdateJsonObjectShouldUpdateUser(){
        $user = new User();
        $user->setId("5");
        $user->setLogin("root");
        $user->setPwd("root");
        $user->setFlag("1");
        $user = json_encode($user);
        $controller = new UsersController();
        $this->assertEqual($controller->updateJsonObject($user),'true');
    }
}