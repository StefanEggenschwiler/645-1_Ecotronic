<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Admin.php';

class AdminDAO
{
    // Database Connection
    private $_conn;

    public function __construct()
    {
        $this->_conn = new PdoConnector();
    }

    public function authenticate($username, $password) {
        $stmt = $this->_conn->getConnection()->prepare('
        SELECT * FROM admin WHERE username = :username');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Admin');
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $admin = $stmt->fetch();
            if (password_verify($password, $admin->getPassword())) {
                return $admin;
            } else {
                return false;
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
        return $stmt->execute();
    }
}