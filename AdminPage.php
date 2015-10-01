<?php
require_once 'dto/class.Admin.php';

session_start();


if (isset ( $_SESSION ['user'] )) {
    $admin = $_SESSION ['user'];


}
else
{
    header ('location: Login.php');
    exit;
}

?>



<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" href="css/adminPage.css" type="text/css" media="all" />
</head>
<body>
<div id="header">
    <div class="shell">
        <div id="top">
            <div id="top-navigation">
                Welcome <strong><?php echo $admin->getUsername(); ?></strong>
                <span>|</span>
                <a href="#">Profile Settings</a>
                <span>|</span>

                <a href="logout.php">Log out</a> <!--end the session and go back to the index page-->
            </div>

        </div>

        <div id="navigation">
            <ul>
                <li><a href="#" class="active"><span>Add a new article</span></a></li>
                <li><a href="#"><span>Update/Delete an article</span></a></li>
                <li><a href="#"><span>Change discount</span></a></li>
                <li><a href="#"><span>Manage Translations</span></a></li>
            </ul>
        </div>
    </div>
</div>
