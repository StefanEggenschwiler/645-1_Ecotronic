<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Admin.php';

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
    <link rel="shortcut icon" type="image/x-icon" href="../images/icons/FavIcon.ico" />

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="../css/adminPage.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="../css/manageAdminPages.css" type="text/css" media="all"/>

    <script type="text/javascript" src="../javascript/javascript.js"></script>
    <!-- load jquery ui css-->
    <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <!-- load jquery library -->
    <script src="../javascript/jquery-1.11.3.min.js"></script>
    <!-- load jquery ui js file -->
    <script src="../javascript/jquery-ui.min.js"></script>
    <!-- load jquery doublescroll js file -->
    <script src="../javascript/jquery.doubleScroll.js"></script>

    <div id="header">
        <div class="shell980W">
            <div id="top">
                <div id="topRightBlock">
                    Welcome <strong><?php echo $admin->getUsername();?></strong>
                    <span>|</span>
                    <a href="../logout.php">Logout</a>
                </div>
            </div>

            <div id="navigation">
                <ul>
                    <li class="<?php echo ($pageName == "addNewDevice.php" ? "active" : "")?>"><a id="nav" href="./addNewDevice.php"><span>Add Device</span></a></li>
                    <li class="<?php echo ($pageName == "manageDevices.php" ? "active" : "")?>"><a id="nav" href="./manageDevices.php"><span>Edit Devices</span></a></li>
                    <li class="<?php echo ($pageName == "manageCategories.php" ? "active" : "")?>"><a id="nav" href="./manageCategories.php"><span>Manage Categories</span></a></li>
                    <li class="<?php echo ($pageName == "manageBrands.php" ? "active" : "")?>"><a id="nav" href="./manageBrands.php"><span>Manage Brands</span></a></li>
                    <li class="<?php echo ($pageName == "manageEfficiencyClasses.php" ? "active" : "")?>"><a id="nav" href="./manageEfficiencyClasses.php"><span>Manage Efficiency Classes</span></a></li>
                    <li class="<?php echo ($pageName == "editTranslation.php" ? "active" : "")?>"><a id="nav" href="./editTranslation.php"><span>Manage Translation</span></a></li>
                    <li class="<?php echo ($pageName == "editFormula.php" ? "active" : "")?>"><a id="nav" href="./editFormula.php"><span>Manage Formula</span></a></li>
                </ul>
            </div>
        </div>
    </div>

</head>

<body>
