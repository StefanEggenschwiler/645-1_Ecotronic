<?php
include $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/functions/cryption.php';
require_once 'class.Model.php';
$action = $_REQUEST['action'];
$model = new Model();
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
            $model->updateDevice($deviceId, $columnName, $value);
            //set columnName = value where Id = deviceId;
        }
        if(count($explode) == 3) {
            $columnName = $explode[0];
            $deviceId = $explode[1];
            $model->updateDevice($deviceId, $columnName, $value, true);
            //set columnName = value where Id = deviceId;
        }
        break;

    case "deleteDevice":
        $deviceId = decrypt($_POST['value']);
        $model->deleteDevice($deviceId);
        break;

    case "addType":
        $value 	= $_POST['typeName'];
        var_dump($model->createType($value));
        break;

    case "updateType":
        $crypto = decrypt($_POST['crypto']);
        $value 	= $_POST['value'];
        $explode = explode('|', $crypto);
        $typeId = $explode[1];
        $model->updateType($typeId, $value);
        break;

    case "deleteType":
        $typeId = decrypt($_POST['value']);
        $model->deleteType($typeId);
        break;

    case "addBrand":
        $value 	= $_POST['brandName'];
        $model->createBrand($value);
        break;

    case "updateBrand":
        $crypto = decrypt($_POST['crypto']);
        $value 	= $_POST['value'];
        $explode = explode('|', $crypto);
        $brandId = $explode[1];
        $model->updateBrand($brandId, $value);
        break;

    case "deleteBrand":
        $brandId = decrypt($_POST['value']);
        $model->deleteBrand($brandId);
        break;

    case "addEfficiencyClass":
        $value 	= $_POST['efficiencyClassName'];
        $model->createEfficiencyClass($value);
        break;

    case "updateEfficiencyClass":
        $crypto = decrypt($_POST['crypto']);
        $value 	= $_POST['value'];
        $explode = explode('|', $crypto);
        $efficiencyClassId = $explode[1];
        $model->updateEfficiencyClass($efficiencyClassId, $value);
        break;

    case "deleteEfficiencyClass":
        $efficiencyClassId = decrypt($_POST['value']);
        $model->deleteEfficiencyClass($efficiencyClassId);
        break;
}