<?php
/**
 * Created by PhpStorm.
 * User: Muhamed
 * Date: 25.09.2015
 * Time: 09:42
 */
include_once 'translations/class.Translator.php';
$translate;
if (isset ( $_GET ['lang'] )) {
    $translate = new Translator ( $_GET ['lang'] );
} else {
    $translate = new Translator ( 'en' );
}
session_start();
$_SESSION["lang"] = "";

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = substr($actual_link, -2);
if($actual_link == 'fr' || $actual_link == 'de' || $actual_link == 'it'){
    $_SESSION['lang'] = '?lang='.$actual_link;
}else{
    $_SESSION['lang'] = '';
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Eco Electronics</title>
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="javascript/javascript.js"></script>
</head>
<body>
<div class="bannerHead">
    <a href="index.php"><img src="images/logo.png" id="logo" alt="EcoElectronics" title="Accueil"></a>

<!-- search bar to find your device-->
    <div class="centerVertical">
        <form method="post" action="login.php">
            <input id="searchBar" type="text" name="searchBar" value="" placeholder="<?php $translate->__('Find your old product...')?>">
            <input id="searchButton" type="submit" name="searchButton" value="<?php $translate->__('Search')?>">
        </form>
        <a class="italicText" href="genericDevice.php" alt="Generic device" title="Generic device"><?php $translate->__('I have no idea') ?></a>
    </div>



<div class="languages">
    <a href="index.php"><img class ="flags" src="images/flags/flagEN.png" alt="EN" title="English"></a>
    <a href="index.php?lang=fr"><img class ="flags"  src="images/flags/flagFR.png" alt="FR" title="Français"></a>
    <a href="index.php?lang=de"><img class ="flags" src="images/flags/flagDE.png" alt="DE" title="Deutsch"></a>
    <a href="index.php?lang=it"><img class ="flags" src="images/flags/flagIT.png" alt="IT" title="Italien"></a>
</div>

</div>
