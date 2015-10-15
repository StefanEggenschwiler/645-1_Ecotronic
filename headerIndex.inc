<?php
/**
 * Created by PhpStorm.
 * User: Muhamed
 * Date: 25.09.2015
 * Time: 09:42
 */
require_once 'dto/class.Device.php';
if (!strpos("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", "?lang=")) {
    header("Location: ".$_SERVER['PHP_SELF']."?lang=".$_COOKIE['lang']);
    exit;
}

include_once 'translations/class.Translator.php';

$cookie_name = 'lang';
$cookie_value;
$translate;

if (isset ( $_GET ['lang'] )) {
    $translate = new Translator ( $_GET ['lang'] );
    $cookie_value = $_GET['lang'];
}
session_start();
$_SESSION["lang"] = "";
if(!isset($_SESSION['comparedDevices'])){
    $_SESSION['comparedDevices'] = array();
}

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$languageValue = substr($actual_link, -2);
if($languageValue == 'fr' || $languageValue == 'de' || $languageValue == 'it'){
    $_SESSION['lang'] = '?lang='.$languageValue;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}else{
    $_SESSION['lang'] = '?lang=en';
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}
header('Content-Type: text/html; charset=UTF-8');

?>


<!DOCTYPE html>
<html>
<head>
    <title>Eco Electronics</title>
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="javascript/javascript.js"></script>
    <!-- load jquery ui css-->
    <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <!-- load jquery library -->
    <script src="javascript/jquery-1.11.3.min.js"></script>
    <!-- load jquery ui js file -->
    <script src="javascript/jquery-ui.min.js"></script>
</head>
<body>
<div class="bannerHead">
    <a href="index.php"><img src="images/logo.png" id="logo" alt="EcoElectronics" title="Accueil"></a>

<!-- search bar to find your device-->
    <div class="centerVertical">
        <!-- start of the form for the whol page, ends in index.php-->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];
        echo $_SESSION['lang'];?>">
            <input id="searchBar" type="text" name="searchBar" placeholder="<?php $translate->__('Find your old product...')?>">
            <input id="searchButton" type="submit" name="searchBarButton" value="<?php $translate->__('Search')?>">

        <a class="italicText" href="genericDevice.php" alt="Generic device" title="Generic device"><?php $translate->__('I have no idea')?></a>
    </div>
<div class="languages">
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=en';?>"><img class ="flags" src="images/flags/flagEN.png" alt="EN" title="English"></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=fr';?>"><img class ="flags"  src="images/flags/flagFR.png" alt="FR" title="Français"></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=de';?>"><img class ="flags" src="images/flags/flagDE.png" alt="DE" title="Deutsch"></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=it';?>"><img class ="flags" src="images/flags/flagIT.png" alt="IT" title="Italien"></a>
</div>

</div>
<script type="text/javascript">
    $(function() {
        var availableTags =
            <?php
            include('database/class.Model.php');
            $model = new Model();
            $model->getAutoCompleteEntries();
            ?>;
        $("#searchBar").autocomplete({
            source: availableTags,
            autoFocus:true
        });
    });
</script>
