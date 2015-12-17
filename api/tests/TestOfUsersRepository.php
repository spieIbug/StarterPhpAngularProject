<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(dirname(__FILE__) . '/simpletest/mock_objects.php');
require_once(dirname(__FILE__) . '/simpletest/simpletest.php');
require_once('../classes/repositories/UsersRepository.php');
require_once('../classes/model/User.php');

class TestOfUsersRepository extends UnitTestCase {
    function testShouldNotBeEqualElementById1() {
        $userExpected =  new User();
        $userExpected->setId(2);
        $userExpected->setLogin("ramzi");
        $userExpected->setPwd("admin");
        $userExpected->setFlag("1");
        $userRepository = new UsersRepository();
        $user = $userRepository->getElementById(1);
        $this->assertNotEqual($userExpected, $user);
    }
    function testShouldBeEqualElementById1() {
        $userExpected =  new User();
        $userExpected->setId(1);
        $userExpected->setLogin("meyacine");
        $userExpected->setPwd("root");
        $userExpected->setFlag("1");
        $userRepository = new UsersRepository();
        $user = $userRepository->getElementById(1);
        $this->assertEqual($userExpected, $user);
    }
    function testShouldSizeBeOf2() {
        $expectedSize = 3;
        $userRepository = new UsersRepository();
        $users = $userRepository->getAllElements();
        $this->assertEqual(sizeof($users), $expectedSize);
    }
    function testUserNotSaving(){
        $user = new User();
        $user->setLogin('admin');
        $user->setPwd('admin');
        $user->setFlag('1');
        $userRepository = new UsersRepository();
        $count = $userRepository->saveElement($user);
        $this->assertEqual($count, false);
    }
}
?>