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

if(isset($_POST['compareButton'])){
    $indexLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $indexLink = str_replace("index","comparison",$indexLink);
    header('Location: '.$indexLink);
    exit();
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
    <link rel="stylesheet" media="screen and (max-width: 1023px)" type="text/css" href="./css/styleMobile.css">
    <script type="text/javascript" src="./javascript/javascript.js"></script>
    <!-- load jquery ui css-->
    <link href="./css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <!-- load jquery library -->
    <script src="./javascript/jquery-1.11.3.min.js"></script>
    <!-- load jquery ui js file -->
    <script src="./javascript/jquery-ui.min.js"></script>
</head>
<body>
<div class="bannerHead">
    <a href="./index.php"><img src="./images/logo.png" id="logo" alt="EcoElectronics" title="Accueil"></a>

<!-- search bar to find your device-->
    <div class="centerVertical">
        <!-- start of the form for the whol page, ends in index.php-->
        <form method="post" action="<?php
        echo $_SERVER['PHP_SELF'];
        echo $_SESSION['lang'];?>">
            <input id="searchBar" type="text" name="searchBar" placeholder="<?php $translate->__('Find your product...')?>">
            <input id="searchButton" type="submit" name="searchBarButton" value="<?php $translate->__('Search')?>">

        <a class="italicText" href="genericDevice.php<?php echo $_SESSION['lang']?>" alt="Generic device" title="Generic device"><?php $translate->__('I have no idea')?></a>
    </div>
<?php
include_once 'headerLanguages.inc'
?>

</div>
<script type="text/javascript">
    $(function() {
        var availableTags =
            <?php
            $model->getAutoCompleteEntries();
            ?>;
        $("#searchBar").autocomplete({
            source: availableTags,
            autoFocus:true
        });
    });
</script>
