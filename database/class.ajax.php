<?php
include $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/functions/cryption.php';
require_once 'class.Model.php';
$action = $_REQUEST['action'];
$model = new Model();
$columnName = null;
$deviceId = null;

switch($action) {
    case "update":
        $crypto = decrypt($_POST['crypto']);
        $value 	= $_POST['value'];
        $explode = explode('|', $crypto);
        var_dump($crypto);
        var_dump($value);
        if(count($explode) == 2) {
            $columnName = $explode[0];
            $deviceId = $explode[1];
            var_dump($model->updateDevice($deviceId, $columnName, $value));
            //set columnName = value where Id = deviceId;
        }
        if(count($explode) == 3) {
            $columnName = $explode[0];
            $deviceId = $explode[1];
            var_dump($model->updateDevice($deviceId, $columnName, $value, true));
            //set columnName = value where Id = deviceId;
        }
        break;

    case "delete":
        $deviceId = decrypt($_POST['value']);
        echo $deviceId;
        $model->deleteDevice($deviceId);
        break;
}