<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Type.php';

/*
 * This class is used as DataAccessObject for the type table in the database.
 * It offers the CRUD operations in addition to different getters used by multiple
 * pages. Prepared statements are used wherever possible.
 *
 * Since we use PDO for the database connection we fetch the result set of the SELECT
 * statements into an array of DTO objects of the specified type and use the array as
 * the functions return value. Source: http://php.net/manual/en/pdostatement.fetchobject.php
 */
class TypeDAO
{
    // Database Connection
    private $_conn;

    public function __construct()
    {
        $this->_conn = new PdoConnector();
    }

    public function getAll() {
        $stmt = $this->_conn->getConnection()->query('
        SELECT * FROM type');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Type');
        return $stmt->fetchAll();
    }

    public function getIdByName($typeName) {
        $stmt = $this->_conn->getConnection()->prepare('
        SELECT id FROM type WHERE typeName = :typeName');
        $stmt->bindParam(':typeName', $typeName, PDO::PARAM_STR, 50);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($typeName) {
        $stmt = $this->_conn->getConnection()->prepare('
        INSERT IGNORE INTO type (typeName) VALUES (:typeName)');
        $stmt->bindParam(':typeName', $typeName, PDO::PARAM_STR, 50);
        return $stmt->execute();
    }

    public function update($typeId, $newName) {
        $stmt = $this->_conn->getConnection()->prepare('
          UPDATE type
            SET typeName = :newName
          WHERE id = :typeId');
        $stmt->bindParam(':typeId', $typeId, PDO::PARAM_INT);
        $stmt->bindParam(':newName', $newName, PDO::PARAM_STR, 50);
        return $stmt->execute();
    }

    public function delete($typeId) {
        $stmt = $this->_conn->getConnection()->prepare('
        DELETE FROM type WHERE id = :typeId');
        $stmt->bindParam(':typeId', $typeId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}