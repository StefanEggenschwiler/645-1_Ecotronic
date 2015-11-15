<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.EfficiencyClass.php';

/*
 * This class is used as DataAccessObject for the efficiencyclass table in the database.
 * It offers the CRUD operations in addition to different getters used by multiple
 * pages. Prepared statements are used wherever possible.
 *
 * Since we use PDO for the database connection we fetch the result set of the SELECT
 * statements into an array of DTO objects of the specified type and use the array as
 * the functions return value. Source: http://php.net/manual/en/pdostatement.fetchobject.php
 */
class EfficiencyClassDAO
{
    // Database Connection
    private $_conn;

    public function __construct()
    {
        $this->_conn = new PdoConnector();
    }

    public function getAll() {
        $stmt = $this->_conn->getConnection()->query('
        SELECT * FROM efficiencyclass');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'EfficiencyClass');
        return $stmt->fetchAll();
    }

    public function getIdByName($efficiencyClassName) {
        $stmt = $this->_conn->getConnection()->prepare('
        SELECT id FROM efficiencyclass WHERE className = :efficiencyClassName');
        $stmt->bindParam(':efficiencyClassName', $efficiencyClassName, PDO::PARAM_STR, 50);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getByType($typeName) {
        $stmt = $this->_conn->getConnection()->prepare('
        SELECT DISTINCT efficiencyclass.id, efficiencyclass.className
          FROM efficiencyclass, type, device
          WHERE device.typeId  = type.id
	        AND device.efficiencyClassId = efficiencyclass.id
            AND type.typeName  = :typeName');
        $stmt->bindParam(':typeName', $typeName, PDO::PARAM_STR, 60);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'EfficiencyClass');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($efficiencyClassName) {
        $stmt = $this->_conn->getConnection()->prepare('
        INSERT IGNORE INTO efficiencyclass (className) VALUES (:efficiencyClassName)');
        $stmt->bindParam(':efficiencyClassName', $efficiencyClassName, PDO::PARAM_STR, 50);
        return $stmt->execute();
    }

    public function update($efficiencyClassId, $newName) {
        $stmt = $this->_conn->getConnection()->prepare('
          UPDATE efficiencyclass
            SET className = :newName
          WHERE id = :efficiencyClassId');
        $stmt->bindParam(':efficiencyClassId', $efficiencyClassId, PDO::PARAM_INT);
        $stmt->bindParam(':newName', $newName, PDO::PARAM_STR, 50);
        return $stmt->execute();
    }

    public function delete($efficiencyClassId) {
        $stmt = $this->_conn->getConnection()->prepare('
        DELETE FROM efficiencyclass WHERE id = :efficiencyClassId');
        $stmt->bindParam(':efficiencyClassId', $efficiencyClassId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}