<?php
include_once 'database/class.Admin.php';
require_once 'class.MySqlConnector.php';

class MySqlManager {

    private $_conn;

    public function __construct(){
        $this->_conn = new MySqlConn();
    }

    public function createAdmin($fname, $lname, $uname, $pwd) {
        $pwd = password_hash($pwd, PASSWORD_BCRYPT);
        $query = "INSERT INTO admin(firstname, lastname,
	username, password) VALUES('$fname',
	'$lname', '$uname', '$pwd');";
        return $this->_conn->executeQuery($query);
    }

    public function checkLogin($uname, $pwd){
        $query = "SELECT * FROM admin WHERE username='$uname'";
        $result = $this->_conn->selectDB($query);
        $row = $result->fetch();
        if($row) {
            if (password_verify($pwd, $row['password'])) {
                return new Admin($row['id'], $row['firstname'], $row['lastname'],
                    $row['username']);
            }
        }
        return false;
    }

    public function getBrandNames(){
        $query = "SELECT * FROM brand";

    }
}