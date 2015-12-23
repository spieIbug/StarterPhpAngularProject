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
    function setUp() {
        echo "<div style='border: 2px solid;border-radius: 5px;padding: 10px;margin: 5px;'>";
    }
    function tearDown() {
        echo "</div>";
    }
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
    function testSaveAndDeleteShouldSizeBeOf7() {
        $role =  new Role();
        $role->setLibelle("tierce");
        $role->setFlag("1");
        $rolesRepository = new RolesRepository();
        $role = $rolesRepository->saveElement($role);
        $expectedSize = 8;
        $roles = $rolesRepository->getAllElements();
        $this->assertEqual(sizeof($roles), $expectedSize); // Test l'ajout
        $rolesRepository->deleteElementById($role->getId());
        $expectedSize = 7;
        $rolesRepository = new RolesRepository();
        $roles = $rolesRepository->getAllElements();
        $this->assertEqual(sizeof($roles), $expectedSize);// Test la suppression
    }
    function testUpdate(){
        $role =  new Role();
        $role->setId(1);
        $role->setLibelle("tiers");
        $role->setFlag("1");
        $rolesRepository = new RolesRepository();
        $nombre = $rolesRepository->updateElement($role);
        $this->assertEqual($nombre,1);

    }
    function testGetAll() {
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