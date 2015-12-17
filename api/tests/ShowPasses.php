<?php
require_once(dirname(__FILE__) . '/simpletest/reporter.php');
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 16/12/2015
 * Time: 15:10
 */
class ShowPasses extends HtmlReporter{
    function paintPass($message) {
        parent::paintPass($message);
        print "<span class=\"pass\">Pass</span>: ";
        $breadcrumb = $this->getTestList();
        array_shift($breadcrumb);
        print implode("->", $breadcrumb);
        print "<br>$message<br />\n";
    }

    /**
     * @param string $test_name
     */
    function paintHeader($test_name) {
        parent::paintHeader($test_name); // TODO: Change the autogenerated stub
    }

}