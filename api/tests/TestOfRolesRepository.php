<?php

require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(dirname(__FILE__) . '/simpletest/mock_objects.php');
require_once(dirname(__FILE__) . '/simpletest/simpletest.php');
require_once('../classes/repositories/RolesRepository.php');
require_once('../classes/model/Role.php');
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 16/12/2015
 * Time: 15:19
 */
class TestOfRolesRepository  extends UnitTestCase{
    function testShouldNotBeEqualElementById1() {
        $roleExpected =  new Role();
        $roleExpected->setId(1);
        $roleExpected->setLibelle("tiersErroné");
        $roleExpected->setFlag("1");
        $roleRepository = new RolesRepository();
        $role = $roleRepository->getElementById(1);
        $this->assertNotEqual($roleExpected, $role);
    }
    function testShouldBeEqualElementById1() {
        $roleExpected =  new Role();
        $roleExpected->setId(1);
        $roleExpected->setLibelle("tiers");
        $roleExpected->setFlag("1");
        $roleRepository = new RolesRepository();
        $role = $roleRepository->getElementById(1);
        $this->assertEqual($roleExpected, $role);
    }
    function testShouldSizeBeOf7() {
        $expectedSize = 7;
        $rolesRepository = new RolesRepository();
        $roles = $rolesRepository->getAllElements();
        $this->assertEqual(sizeof($roles), $expectedSize);
    }
    function testRoleNotSaving(){
        $role = new Role();
        $role->setLibelle('admin');
        $role->setFlag('1');
        $rolesRepository = new RolesRepository();
        $count = $rolesRepository->saveElement($role);
        $this->assertEqual($count, false);
    }
}