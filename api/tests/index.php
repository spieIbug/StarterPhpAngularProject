<?php
require_once(dirname(__FILE__) . '/ShowPasses.php');
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(dirname(__FILE__) . '/simpletest/simpletest.php');
SimpleTest::prefer(new ShowPasses());
class AllTests extends TestSuite {
    function __construct() {
        parent::__construct('All tests');

        $this->addFile(dirname(__FILE__).'/TestOfUsersRepository.php');
        $this->addFile(dirname(__FILE__).'/TestOfRolesRepository.php');
        $this->addFile(dirname(__FILE__).'/TestOfUserRolesRepository.php');
        $this->addFile(dirname(__FILE__).'/TestOfUsersJsonController.php');
    }
}
?>