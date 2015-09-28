<?php
require_once 'database/class.MySqlManager.php';
/**
 * Created by PhpStorm.
 * User: Sasa
 * Date: 28.09.15
 * Time: 11:28
 */
$mysql = new MySqlManager ();

if (isset ( $_POST ['action'] )) {
    if ($_POST ['action'] == 'login') {
        authenticate($mysql);
    }
}

function authenticate($mysql) {
    $uname = $_POST['user'];
    $pwd = $_POST['pwd'];
    $result = $mysql->checkLogin($uname, $pwd);
    if (!$result) {
        echo 'no result!';
        exit;
    }
    exit;
}
?>