<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(dirname(__FILE__) . '/simpletest/mock_objects.php');
require_once(dirname(__FILE__) . '/simpletest/simpletest.php');
require_once('../classes/repositories/UserRoleRepository.php');
require_once('../classes/model/UserRole.php');
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 18/12/2015
 * Time: 15:45
 */
class TestOfUserRolesRepository extends UnitTestCase{
    function setUp() {
        echo "<div style='border: 2px solid;border-radius: 5px;padding: 10px;margin: 5px;'>";
    }
    function tearDown() {
        echo "</div>";
    }
    function testShouldBeEqualElementById1() {
        $userRoleExpected =  new UserRole();
        $userRoleExpected->setUserId(1);
        $userRoleExpected->setRoleId(3);
        $userRoleExpected->setFlag(1);
        $userRoleExpected->setId(1);
        $userRoleRepository = new UserRoleRepository();
        $userRole = $userRoleRepository->getElementById(1);
        $this->assertEqual($userRoleExpected, $userRole);
    }
    function testShouldNotBeEqualElementById1() {
        $userRoleExpected =  new UserRole('1','3','1');
        $userRoleExpected->setId('1');
        $userRoleRepository = new UserRoleRepository();
        $userRole = $userRoleRepository->getElementById(2);
        $this->assertNotEqual($userRoleExpected, $userRole);
    }
    function testGetUserRolesByUserId(){
        $userRoleExpected =  new Role();
        $userRoleExpected->setId("3");
        $userRoleExpected->setLibelle("comptable");
        $userRoleExpected->setFlag("1");
        $userRolesExpected[0]=$userRoleExpected;
        $userRoleExpected =  new Role();
        $userRoleExpected->setId(4);
        $userRoleExpected->setLibelle("contentieux");
        $userRoleExpected->setFlag("1");
        $userRolesExpected[1]=$userRoleExpected;
        $userRoleRepository = new UserRoleRepository();
        $userRoles = $userRoleRepository->getUserRolesByUserId(1);
        $this->assertEqual($userRolesExpected, $userRoles);
    }
    function testGetRoleUsersByRoleId(){
        $roleUserExpected =  new User();
        $roleUserExpected->setId("1");
        $roleUserExpected->setLogin("meyacine");
        $roleUserExpected->setPwd("root");
        $roleUserExpected->setFlag("1");
        $roleUsersExpected[0]=$roleUserExpected;
        $userRoleRepository = new UserRoleRepository();
        $roleUsers = $userRoleRepository->getRoleUsersByRoleId(3);
        $this->assertEqual($roleUsersExpected, $roleUsers);
        $this->assertEqual($roleUsersExpected[0]->getLogin(), $roleUsers[0]->getLogin());
    }
}