<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/translations/class.Translator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.Model.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Device.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Type.php';
$model = new Model();
if (isset ( $_GET ['lang'] )) {
    $translate = new Translator ( $_GET ['lang'] );
} else {
    $translate = new Translator ( 'en' );
}

header('Content-Type: text/html; charset=UTF-8');
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Eco Electronics</title>
    <link rel="shortcut icon" type="image/x-icon" href="./images/icons/FavIcon.ico" />
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" media="screen and (min-width: 1024px)" type="text/css" href="./css/style.css">
    <link rel="stylesheet" media="screen and (max-width: 1023px)" type="text/css" href="./css/styleMobile.css">
    <script type="text/javascript" src="./javascript/javascript.js"></script>
</head>
<body>
<div class="bannerHead">
    <a href="./index.php"><img src="./images/logo.png" id="logo" alt="EcoElectronics" title="Accueil"></a>

<div class="languages">
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=en';?>"><img class ="flags" src="./images/flags/flagEN.png" alt="EN" title="English"></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=fr';?>"><img class ="flags"  src="./images/flags/flagFR.png" alt="FR" title="Français"></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=de';?>"><img class ="flags" src="./images/flags/flagDE.png" alt="DE" title="Deutsch"></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=it';?>"><img class ="flags" src="./images/flags/flagIT.png" alt="IT" title="Italien"></a>
</div>

</div>