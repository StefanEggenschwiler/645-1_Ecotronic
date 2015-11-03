<?php

include_once 'translations/class.Translator.php';
include_once 'database/class.Model.php';
include_once 'dto/class.Device.php';
$translate;
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
    <link rel="shortcut icon" type="image/x-icon" href="images/icons/FavIcon.ico" />
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="javascript/javascript.js"></script>
</head>
<body>
<div class="bannerHead">
    <a href="index.php"><img src="images/logo.png" id="logo" alt="EcoElectronics" title="Accueil"></a>




<div class="languages">
    <a href="index.php"><img class ="flags" src="images/flags/flagEN.png" alt="EN" title="English"></a>
    <a href="index.php?lang=fr"><img class ="flags"  src="images/flags/flagFR.png" alt="FR" title="Français"></a>
    <a href="index.php?lang=de"><img class ="flags" src="images/flags/flagDE.png" alt="DE" title="Deutsch"></a>
    <a href="index.php?lang=it"><img class ="flags" src="images/flags/flagIT.png" alt="IT" title="Italien"></a>
</div>

</div>
