<?php
require_once 'database/class.Model.php';
/**
 * Created by PhpStorm.
 * User: Sasa
 * Date: 28.09.15
 * Time: 11:28
 */

if (isset ( $_POST ['action'] )) {
    if ($_POST ['action'] == 'login') {
        authenticate();
    }
} else {
    echo 'ACCESS DENIED!';
}

function authenticate() {
    $model = new Model ();
    $uname = $_POST['user'];
    $pwd = $_POST['pwd'];
    $result = $model->checkLogin($uname, $pwd);
    if (!$result) {
        exit;
    }
    exit;
}
?>