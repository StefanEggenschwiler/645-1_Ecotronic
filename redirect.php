<?php
require_once 'database/class.Model.php';


if (isset ( $_POST ['action'] )) {
    if ($_POST ['action'] == 'login') {
        authenticate(); // the user is logging in
    }
} else {
    echo 'ACCESS DENIED!';
}


// checking if the username + pwd are correct
function authenticate() {
    $model = new Model ();
    $uname = $_POST['user'];
    $pwd = $_POST['pwd'];
    $result = $model->checkLogin($uname, $pwd);

    if (!$result) { // something is wrong
        exit;
    }

    session_start(); // the result is Admin Object, successfully logged in, the sessions start
    $_SESSION['user'] = $result;

    header ('location: adminPage.php');
    exit;
}


?>





