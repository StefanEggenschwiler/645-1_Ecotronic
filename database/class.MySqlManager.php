<?php
include_once 'database/class.User.php';
require_once 'class.MySqlConn.php';

class MySqlManager {

    private $_conn;

    public function __construct(){
        $this->_conn = new MySqlConn();
    }

    public function saveUser($fname, $lname, $uname, $pwd) {
        $pwd = sha1 ( $pwd );
        $query = "INSERT into user(firstname, lastname,
	username, password) VALUES('$fname',
	'$lname', '$uname', '$pwd');";
        return $this->_conn->executeQuery($query);
    }

    public function checkLogin($uname, $pwd){
        $query = "SELECT * FROM user WHERE username='$uname'";
        $result = $this->_conn->selectDB($query);
        $row = $result->fetch();
        if($row) {
            if (password_verify($pwd, $row['password'])) {
                return new User($row['id'], $row['firstname'], $row['lastname'],
                    $row['username']);
            } else {
                return false;
            }

        }
        return false;
    }
}