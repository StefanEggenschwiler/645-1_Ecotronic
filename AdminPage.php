<?php
require_once 'dto/class.Admin.php';

$admin = new Admin();

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




