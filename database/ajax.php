<?php
/*
 * This php file is used as abstraction for ajax calls.
 * It is used solely for CRUD operations used in the admin part.
 *
 * For security reasons all the database values (column name, id)
 * are encoded using base64. The call will decoded and the method
 * called on the controller.
 */
include $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/functions/cryption.php';
require_once 'class.Controller.php';
$action = $_REQUEST['action'];
$controller = new Controller();
$columnName = null;
$deviceId = null;

switch($action) {
    case "updateDevice":
        $crypto = decrypt($_POST['crypto']);
        $value 	= $_POST['value'];
        $explode = explode('|', $crypto);
        if(count($explode) == 2) {
            $columnName = $explode[0];
            $deviceId = $explode[1];
            $controller->updateDevice($deviceId, $columnName, $value);
            //set columnName = value where id = deviceId;
        }
        if(count($explode) == 3) {
            $columnName = $explode[0];
            $deviceId = $explode[1];
            $controller->updateDevice($deviceId, $columnName, $value, true);
            //set columnName = value where id = deviceId;
        }
        break;

    case "deleteDevice":
        $deviceId = decrypt($_POST['value']);
        $controller->deleteDevice($deviceId);
        break;

    case "addType":
        $value 	= $_POST['typeName'];
        $controller->createType($value);
        break;

    case "updateType":
        $crypto = decrypt($_POST['crypto']);
        $value 	= $_POST['value'];
        $explode = explode('|', $crypto);
        $typeId = $explode[1];
        $controller->updateType($typeId, $value);
        break;

    case "deleteType":
        $typeId = decrypt($_POST['value']);
        $controller->deleteType($typeId);
        break;

    case "addBrand":
        $value 	= $_POST['brandName'];
        $controller->createBrand($value);
        break;

    case "updateBrand":
        $crypto = decrypt($_POST['crypto']);
        $value 	= $_POST['value'];
        $explode = explode('|', $crypto);
        $brandId = $explode[1];
        $controller->updateBrand($brandId, $value);
        break;

    case "deleteBrand":
        $brandId = decrypt($_POST['value']);
        $controller->deleteBrand($brandId);
        break;

    case "addEfficiencyClass":
        $value 	= $_POST['efficiencyClassName'];
        $controller->createEfficiencyClass($value);
        break;

    case "updateEfficiencyClass":
        $crypto = decrypt($_POST['crypto']);
        $value 	= $_POST['value'];
        $explode = explode('|', $crypto);
        $efficiencyClassId = $explode[1];
        $controller->updateEfficiencyClass($efficiencyClassId, $value);
        break;

    case "deleteEfficiencyClass":
        $efficiencyClassId = decrypt($_POST['value']);
        $controller->deleteEfficiencyClass($efficiencyClassId);
        break;
}