<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Discount.php';

class DiscountDAO
{
    // Database Connection
    private $_conn;

    public function __construct()
    {
        $this->_conn = new PdoConnector();
    }

    public function getAll() {
        $stmt = $this->_conn->getConnection()->query('
        SELECT * FROM discount');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Discount');
        return $stmt->fetchAll();
    }

    /*
    public function getByType($typeName) {
        $stmt = $this->_conn->getConnection()->prepare('
        SELECT DISTINCT brand.id, brand.brandName
          FROM brand, type, device
          WHERE device.typeId  = type.id
	        AND device.brandId = brand.id
            AND type.typeName  = :typeName');
        $stmt->bindParam(':typeName', $typeName, PDO::PARAM_STR, 60);
        $stmt->setFetchMode(PDO::FETCH_INTO, new Brand);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function create($brandName) {
        $stmt = $this->_conn->getConnection()->prepare('
        INSERT IGNORE INTO brand (brandName) VALUES (:brandName)');
        $stmt->bindParam(':brandName', $brandName, PDO::PARAM_STR, 60);
        return $stmt->execute();
    }

    public function update($oldName, $newName) {
        $stmt = $this->_conn->getConnection()->prepare('
        IF (NOT EXISTS(SELECT * FROM brand WHERE brandName = :newName))
        BEGIN
            UPDATE brand SET brandName = :newName WHERE brandName = :oldName
        END');
        $stmt->bindParam(':newName', $newName, PDO::PARAM_STR, 60);
        $stmt->bindParam(':oldName', $oldName, PDO::PARAM_STR, 60);
        $stmt->execute();
        if($stmt->rowCount() == 1) {
            return true;
        } else{
            return false;
        }
    }
    */

    public function delete($discountId) {
        $stmt = $this->_conn->getConnection()->prepare('
        DELETE FROM discount WHERE id = :discountId');
        $stmt->bindParam(':discountId', $discountId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}