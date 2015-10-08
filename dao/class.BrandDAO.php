<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Brand.php';

class BrandDAO
{
    // Database Connection
    private $_conn;

    public function __construct()
    {
        $this->_conn = new PdoConnector();
    }

    public function getAll() {
        $stmt = $this->_conn->getConnection()->query('
        SELECT * FROM brand');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Brand');
        return $stmt->fetchAll();
    }

    public function getByType($typeName) {
        $stmt = $this->_conn->getConnection()->prepare('
        SELECT DISTINCT brand.id, brand.brandName
          FROM brand, type, device
          WHERE device.typeId  = type.id
	        AND device.brandId = brand.id
            AND type.typeName  = :typeName');
        $stmt->bindParam(':typeName', $typeName, PDO::PARAM_STR, 60);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Brand');
        $stmt->execute();
        return $stmt->fetchAll();
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
        return $stmt->execute();
    }

    public function delete($brandName) {
        $stmt = $this->_conn->getConnection()->prepare('
        DELETE FROM brand WHERE brandName = :brandName');
        $stmt->bindParam(':brandName', $brandName, PDO::PARAM_STR, 60);
        return $stmt->execute();
    }
}