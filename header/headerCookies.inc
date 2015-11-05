<?php
if (!strpos("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", "?lang=")) {
    header("Location: ".$_SERVER['PHP_SELF']."?lang=".$_COOKIE['lang']);
    exit;
}

$_SESSION["lang"] = "";
$cookie_name = 'lang';

if (isset ( $_GET ['lang'] )) {
    $translate = new Translator ( $_GET ['lang'] );
    $cookie_value = $_GET['lang'];
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