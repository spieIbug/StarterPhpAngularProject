<?php

/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 16/12/2015
 * Time: 15:56
 */
interface Service {
    public function getJsonObjectById($id);
    public function getJsonArray();
    public function saveJsonObject($jsonObject);
    public function saveJsonArray($jsonArray);
}