<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';

class Type
{
    // Database Connection
    private $_conn;

    // Fields
    public $id = "";
    public $typeName = "";

    public function __construct()
    {
        $this->_conn = new PdoConnector();
    }

    public function getAll() {
        $stmt = $this->_conn->getConnection()->query('
        SELECT * FROM type');
        $stmt->setFetchMode(PDO::FETCH_INTO, new Type);
        return $stmt->fetchAll();
    }

    public function create($typeName) {
        $stmt = $this->_conn->getConnection()->prepare('
        INSERT IGNORE INTO type (typeName) VALUES (:typeName)');
        $stmt->bindParam(':typeName', $typeName, PDO::PARAM_STR, 50);
        return $stmt->execute();
    }

    public function update($oldName, $newName) {
        $stmt = $this->_conn->getConnection()->prepare('
        IF (NOT EXISTS(SELECT * FROM type WHERE typeName = :newName))
        BEGIN
            UPDATE type SET typeName = :newName WHERE typeName = :oldName
        END');
        $stmt->bindParam(':newName', $newName, PDO::PARAM_STR, 50);
        $stmt->bindParam(':oldName', $oldName, PDO::PARAM_STR, 50);
        $stmt->execute();
        if($stmt->rowCount() == 1) {
            return true;
        } else{
            return false;
        }
    }

    public function delete($typeName) {
        $stmt = $this->_conn->getConnection()->prepare('
        DELETE FROM type WHERE typeName = :typeName');
        $stmt->bindParam(':typeName', $typeName, PDO::PARAM_STR, 50);
        return $stmt->execute();
    }
}