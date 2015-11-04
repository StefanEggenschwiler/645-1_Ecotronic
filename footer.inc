<?php

include_once 'translations/class.Translator.php';
if (isset ( $_GET ['lang'] )) {
    $translate = new Translator ( $_GET ['lang'] );
} else {
    $translate = new Translator ( 'en' );
}
?>

<footer id="bannerFooter">
    <div>
        Web Design
        <a href="login.php"><img src="images/icons/copyright.png" id="copyrightLogo" alt="Copyright" title="Copyright"></a>
        HES-SO Valais
    </div>
</footer>

</body>

</html>

