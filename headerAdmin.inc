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

?>



<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="css/adminPage.css" type="text/css" media="all"/>

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
                    <li><a href="adminPage.php" class="active"><span>Admin page</span></a></li>
                    <li><a href="addNewDevice_page.php"><span>Add a new device</span></a></li>
                    <li><a href="#"><span>Update/Delete an article</span></a></li>
                    <li><a href="#"><span>Change discount</span></a></li>
                    <li><a href="#"><span>Manage Translations</span></a></li>
                </ul>
            </div>
        </div>
    </div>

</head>


<body>
