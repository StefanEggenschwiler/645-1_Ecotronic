<?php
header('Content-Type: text/html; charset=UTF-8');
include_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/translations/class.Translator.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Device.php';
include($_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.Model.php');
session_start();
$model = new Model();

include_once 'headerCookies.inc';

if(!isset($_SESSION['comparedDevices'])){
    $_SESSION['comparedDevices'] = array();
}

foreach($_SESSION['comparedDevices'] as $value){
    if (isset($_POST['dev'])) {
        if($_POST['dev'] == $value->getSerialNumber()){
            $_SESSION['myOldDevice'] = $value->getSerialNumber();
        }

    }
}

if(!isset($_SESSION['myOldDevice'])){
    $_SESSION['myOldDevice'] = null;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Eco Electronics</title>
    <link rel="shortcut icon" type="image/x-icon" href="./images/icons/FavIcon.ico" />
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" media="screen and (min-width: 1024px)" type="text/css" href="./css/style.css">
    <link rel="stylesheet" media="screen and (min-width: 1024px)" type="text/css" href="./css/comparisonTable.css">
    <link rel="stylesheet" media="screen and (max-width: 1023px)" type="text/css" href="./css/styleMobile.css">
    <link rel="stylesheet" media="screen and (max-width: 1023px)" type="text/css" href="./css/comparisonTableMobile.css">
</head>
<body>
<div class="bannerHead">
    <a href="./index.php"><img src="./images/logo.png" id="logo" alt="EcoElectronics" title="Index"></a>

    <?php
    include_once 'headerLanguages.inc'
    ?>

</div>