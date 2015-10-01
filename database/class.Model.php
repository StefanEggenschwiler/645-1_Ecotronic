<?php
include_once 'dto/class.Admin.php';
include_once 'dto/class.Device.php';
include_once 'dto/class.Type.php';
include_once 'dto/class.Brand.php';
include_once 'dto/class.EfficiencyClass.php';
require_once 'class.MySqlConnector.php';

class Model {

    private $_conn;

    public function __construct(){
        $this->_conn = new MySqlConnector();
    }

    public function createAdmin($fname, $lname, $uname, $pwd) {
        $pwd = password_hash($pwd, PASSWORD_BCRYPT);
        $query = "INSERT INTO admin(firstname, lastname, username, password) VALUES('$fname', '$lname', '$uname', '$pwd');";
        return $this->_conn->executeQuery($query);
    }

    public function checkLogin($uname, $pwd){
        $uname = $this->_conn->getConnection()->real_escape_string($uname);
        $query = "SELECT * FROM admin WHERE username='$uname'";
        $result = $this->_conn->executeQuery($query);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if (password_verify($pwd, $row['password'])) {
                    echo "User successfully logged in!";
                    return new Admin($row['id'], $row['firstname'], $row['lastname'],
                        $row['username']);
                } else {
                    die(header("location:Login.php?loginFailed=true&reason=password"));
                }
            }
        } else {
            die(header("location:Login.php?loginFailed=true&reason=notfound"));
        }
        return false;
    }

    public function getTypes() {
        $query = "SELECT * FROM type";
        $result = $this->_conn->executeQuery($query);
        $types =  array();

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $types[] = new Type($row["id"], $row["typeName"]);
            }
        } else {
            echo "0 results";
        }
        return $types;
    }

    public function getEfficiencyClasses() {
        $query = "SELECT * FROM efficiencyclass";
        $result = $this->_conn->executeQuery($query);
        $efficiencyClasses =  array();

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $efficiencyClasses[] = new EfficiencyClass($row["id"], $row["className"]);
            }
        } else {
            echo "0 results";
        }
        return $efficiencyClasses;
    }


    public function getBrands(){
        $query = "SELECT * FROM brand";
        $result = $this->_conn->executeQuery($query);
        $brands =  array();

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $brands[] = new Brand($row["id"], $row["brandName"]);
            }
        } else {
            echo "0 results";
        }
        return $brands;
    }
}