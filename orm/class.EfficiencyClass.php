<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';

class EfficiencyClass
{
    // Database Connection
    private $_conn;

    // Fields
    public $id = "";
    public $efficiencyClassName = "";

    public function __construct()
    {
        $this->_conn = new PdoConnector();
    }

    public function getAll() {
        $stmt = $this->_conn->getConnection()->query('
        SELECT * FROM efficiencyclass');
        $stmt->setFetchMode(PDO::FETCH_INTO, new EfficiencyClass);
        return $stmt->fetchAll();
    }

    public function getByType($typeName) {
        $stmt = $this->_conn->getConnection()->prepare('
        SELECT DISTINCT efficiencyclass.id, efficiencyclass.brandName
          FROM efficiencyclass, type, device
          WHERE device.typeId  = type.id
	        AND device.efficiencyClassId = efficiencyclass.id
            AND type.typeName  = :typeName');
        $stmt->bindParam(':typeName', $typeName, PDO::PARAM_STR, 60);
        $stmt->setFetchMode(PDO::FETCH_INTO, new EfficiencyClass);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function create($efficiencyClassName) {
        $stmt = $this->_conn->getConnection()->prepare('
        INSERT IGNORE INTO efficiencyclass (className) VALUES (:efficiencyClassName)');
        $stmt->bindParam(':efficiencyClassName', $efficiencyClassName, PDO::PARAM_STR, 50);
        return $stmt->execute();
    }

    public function update($oldName, $newName) {
        $stmt = $this->_conn->getConnection()->prepare('
        IF (NOT EXISTS(SELECT * FROM efficiencyclass WHERE className = :newName))
        BEGIN
            UPDATE efficiencyclass SET className = :newName WHERE className = :oldName
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

    public function delete($efficiencyClassName) {
        $stmt = $this->_conn->getConnection()->prepare('
        DELETE FROM efficiencyclass WHERE className = :efficiencyClassName');
        $stmt->bindParam(':efficiencyClassName', $efficiencyClassName, PDO::PARAM_STR, 50);
        return $stmt->execute();
    }
}