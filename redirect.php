<?php
/*
 * This php site is used for the redirecting of multiple pages:
 *  login.php
 *  editFormula.php
 *  editTranslation.php
 *
 * Depending on which of those pages access redirect.php different
 * operations will made.
 *
 * Login:
 *      It checks if the login information entered by the user
 *      in the login.php is valid. If it's valid it redirects the user
 *      to the admin part, if it's wrong it redirects back to the login
 *      page showing a message.
 * EditFormula:
 *      If the admin changes parts of the formula which is used in order
 *      to calculate the discount for the device comparison, the changed
 *      values will be stored into the formula.txt located in /database.
 * EditTranslation:
 *      If the admin changes parts of the translation used for the client
 *      side of ecoelectronics, the changed values will be stored into the
 *      corresponding translation files (de.txt, fr.txt, it.txt) located
 *      in /translations.
 *
 * If redirect.php is called without a valid POST request it simply shows
 * the message 'ACCESS DENIED!'.
 */
require_once 'database/class.Model.php';

if (isset ( $_POST ['action'] )) {
    if ($_POST ['action'] == 'login') {
        authenticate(); // the user is logging in
    } else if ($_POST ['action'] == 'translationSubmit') {
        saveTranslationTable();
    } else if ($_POST ['action'] == 'formulaSubmit') {
        saveFormula();
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

    if(!$result) {
        header ('location: login.php');
        exit;
    }
    session_start(); // the result is Admin Object, successfully logged in, the sessions start
    $_SESSION['user'] = $result;

    header ('location: admin/manageDevices.php');
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
    file_put_contents('translations/de.txt', $german);
    file_put_contents('translations/fr.txt', $french);
    file_put_contents('translations/it.txt', $italian);

    header ('location: admin/editTranslation.php');
    exit;
}

function saveFormula() {
    $variables = array();
    foreach($_POST as $inputName => $inputValue) {
        if(strpos("x" . $inputName, 'formula') !== false) {
            $variables[] = str_replace('formula', '', $inputName) . "=" . $inputValue. "\r\n";
        }
    }
    file_put_contents('database/formula.txt', $variables);

    session_start();
    $_SESSION['message'] = 'Changes sucessfully saved!';

    header ('location: admin/editFormula.php');
    exit;
}

