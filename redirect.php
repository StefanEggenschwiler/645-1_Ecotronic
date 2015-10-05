<?php
require_once 'database/class.Model.php';


if (isset ( $_POST ['action'] )) {
    if ($_POST ['action'] == 'login') {
        authenticate(); // the user is logging in
    } else if ($_POST ['action'] == 'translationSubmit') {
        saveTranslationTable();
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

    header ('location: Admin_page.php');
    exit;
}

function saveTranslationTable() {
    $german = array();
    $french = array();
    $italian = array();
    $en = "";
    foreach($_POST as $inputName => $inputValue)
    {
        if(strpos("x" . $inputName,'cell') !== false) {
            if (strpos("x" . $inputName, '_en_') !== false) {
                $en = $inputValue;
            } else if (strpos("x" . $inputName, '_de_') !== false) {
                $german[] = $en . "=" . $inputValue . "\r\n";
            } else if (strpos("x" . $inputName, '_fr_') !== false) {
                $french[] = $en . "=" . $inputValue . "\r\n";
            }
            else if (strpos("x" . $inputName, '_it_') !== false) {
                $italian[] = $en . "=" . $inputValue . "\r\n";
            }
        }
    }
    file_put_contents('translations/de_2.txt', $german);
    file_put_contents('translations/fr_2.txt', $french);
    file_put_contents('translations/it_2.txt', $italian);


    header ('location: editTranslation.php');
    exit;
}
?>





