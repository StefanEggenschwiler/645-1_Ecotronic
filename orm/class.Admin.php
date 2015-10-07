<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';

class Admin
{
    // Database Connection
    private $_conn;

    // Fields
    public $username = "";
    public $firstname = "";
    public $lastname = "";

    public function __construct($username)
    {
        $this->_conn = new PdoConnector();
        $this->username = $username;
    }

    public function authenticate($password) {
        $stmt = $this->_conn->getConnection()->prepare('
        SELECT * FROM admin WHERE username = :username');
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR, 50);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    $this->username = $row['username'];
                    $this->firstname = $row['firstname'];
                    $this->lastname = $row['lastname'];
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function create($username, $firstname, $lastname, $password) {
        $stmt = $this->_conn->getConnection()->prepare('
        INSERT IGNORE INTO admin (username, firstname, lastname, password)
        VALUES (:username, :firstname, :lastname, :password)');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR, 50);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR, 50);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR, 72);

        return $stmt->execute();
    }

    public function update($username, $newFirstname, $newLastname, $newPassword) {
        $stmt = $this->_conn->getConnection()->prepare('
          UPDATE admin SET firstname = :firstname, lastname = :lastname, password = :password
          WHERE username = :username');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $stmt->bindParam(':firstname', $newFirstname, PDO::PARAM_STR, 50);
        $stmt->bindParam(':lastname', $newLastname, PDO::PARAM_STR, 50);
        $stmt->bindParam(':password', password_hash($newPassword, PASSWORD_BCRYPT), PDO::PARAM_STR, 72);
        $stmt->execute();
        if($stmt->rowCount() == 1) {
            return true;
        } else{
            return false;
        }
    }
}