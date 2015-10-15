<?php
require_once 'dto/class.Admin.php';

session_start();


if (isset ( $_SESSION ['user'] )) {
    $admin = $_SESSION ['user'];


}
else
{
    header ('location: login.php');
    exit;
}

header('Content-Type: text/html; charset=UTF-8');

?>



<head>
    <!--Getting the page name, like "admin.php" -->
    <?php  $pageName = basename($_SERVER['PHP_SELF']);?>

    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/icons/FavIcon.ico" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="css/adminPage.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="css/updateDeleteDevice.css" type="text/css" media="all"/>

    <script type="text/javascript" src="javascript/javascript.js"></script>

    <div id="header">
        <div class="shell">
            <div id="top">
                <div id="top-navigation">
                    Welcome <strong><?php echo $admin->getUsername(); ?></strong>
                    <span>|</span>
                    <a href="#">Profile Settings</a>
                    <span>|</span>

                    <a href="logout.php">Log out</a>
                </div>

            </div>

            <div id="navigation">
                <ul>
                    <li class="<?php echo ($pageName == "admin.php" ? "active" : "")?>"><a id="nav" href="admin.php"><span>Admin page</span></a></li>
                    <li class="<?php echo ($pageName == "addNewDevice.php" ? "active" : "")?>"><a id="nav" href="addNewDevice.php"><span>Add a new device</span></a></li>
                    <li class="<?php echo ($pageName == "updateDeleteDevice.php" ? "active" : "")?>"><a id="nav" href="updateDeleteDevice.php"><span>Update/Delete an article</span></a></li>
                    <li class="<?php echo ($pageName == "editDiscount.php" ? "active" : "")?>"><a id="nav" href="editDiscount.php"><span>Change discount</span></a></li>
                    <li class="<?php echo ($pageName == "editTranslation.php" ? "active" : "")?>"><a id="nav" href="editTranslation.php"><span>Manage Translations</span></a></li>
                </ul>
            </div>
        </div>
    </div>

</head>


<body>
