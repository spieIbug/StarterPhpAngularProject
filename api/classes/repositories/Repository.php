<?php

/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 16/12/2015
 * Time: 10:49
 */
interface Repository {
    public function getElementById($id);
    public function getAllElements();
    public function saveElement($object);
    public function saveAllElements($arrayOfObjects);
    public function updateElementById($id);
    public function deleteElementById($id);
}