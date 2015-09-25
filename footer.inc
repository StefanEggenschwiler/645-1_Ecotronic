<?php

include_once 'translations/class.Translator.php';
$translate;
if (isset ( $_GET ['lang'] )) {
    $translate = new Translator ( $_GET ['lang'] );
} else {
    $translate = new Translator ( 'en' );
}
?>
<!DOCTYPE html>
<html>
<head>

</head>


<body>

</body>

<footer id="bannerFooter">
    <div>
        <img id="copyrightLogo" src="images/copyright.png" id="copyright" alt="Copyright" title="Copyright">
    </div>
</footer>

