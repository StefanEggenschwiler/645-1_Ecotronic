<?php
header('Content-Type: text/html; charset=UTF-8');
include_once 'translations/class.Translator.php';
require_once 'dto/class.Device.php';
include('database/class.Model.php');
$model = new Model();


session_start();


if (!strpos("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", "?lang=")) {
    header("Location: ".$_SERVER['PHP_SELF']."?lang=".$_COOKIE['lang']);
    exit;
}
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



$cookie_name = 'lang';
$cookie_value;
$translate;

if (isset ( $_GET ['lang'] )) {
    $translate = new Translator ( $_GET ['lang'] );
    $cookie_value = $_GET['lang'];
}

$_SESSION["lang"] = "";

if(!isset($_SESSION['myOldDevice'])){
    $_SESSION['myOldDevice'] = null;
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


?>


<!DOCTYPE html>
<html>
<head>
    <title>Eco Electronics</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/icons/FavIcon.ico" />
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" media="screen and (min-width: 1024px)" type="text/css" href="css/style.css">
    <link rel="stylesheet" media="screen and (min-width: 1024px)" type="text/css" href="css/comparisonTable.css">
    <link rel="stylesheet" media="screen and (max-width: 1023px)" type="text/css" href="css/styleMobile.css">
    <link rel="stylesheet" media="screen and (max-width: 1023px)" type="text/css" href="css/comparisonTableMobile.css">
</head>
<body>
<div class="bannerHead">
    <a href="index.php"><img src="images/logo.png" id="logo" alt="EcoElectronics" title="Accueil"></a>

<div class="languages">
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=en';?>"><img class ="flags" src="images/flags/flagEN.png" alt="EN" title="English"></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=fr';?>"><img class ="flags"  src="images/flags/flagFR.png" alt="FR" title="Français"></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=de';?>"><img class ="flags" src="images/flags/flagDE.png" alt="DE" title="Deutsch"></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?lang=it';?>"><img class ="flags" src="images/flags/flagIT.png" alt="IT" title="Italien"></a>
</div>

</div>