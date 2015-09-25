<?php
/**
 * Created by PhpStorm.
 * User: Muhamed
 * Date: 25.09.2015
 * Time: 09:42
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>EcoTronic</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<a href="index.php"><img src="images/logo.png" alt="EcoElectronics" title="Accueil"></a>


<form method="post" action="adminLoginPage.php">
    <input type="text" name="searchBar" value="Find your old product..." onfocus="this.value=''">
    <input type="submit" name="searchButton" value="search">
</form>


<a class="flags" title="deutsch" href="index.php?lang=de">
    <img src="images/flagDE.png" alt="DE" title="Deutsch">
</a>
<a class="flags" title="english" href="index.php">
    <img src="images/flagEN.png" alt="EN" title="English">
</a>
<a class="flags" title="français" href="index.php?lang=fr">
    <img src="images/flagFR.png" alt="FR" title="Français">
</a>
