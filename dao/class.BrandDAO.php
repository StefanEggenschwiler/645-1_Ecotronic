<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Brand.php';

/*
 * This class is used as DataAccessObject for the brand table in the database.
 * It offers the CRUD operations in addition to different getters used by multiple
 * pages. Prepared statements are used wherever possible.
 *
 * Since we use PDO for the database connection we fetch the result set of the SELECT
 * statements into an array of DTO objects of the specified type and use the array as
 * the functions return value. Source: http://php.net/manual/en/pdostatement.fetchobject.php
 */
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

    public function getIdByName($brandName) {
        $stmt = $this->_conn->getConnection()->prepare('
        SELECT id FROM brand WHERE brandName = :brandName');
        $stmt->bindParam(':brandName', $brandName, PDO::PARAM_STR, 60);
        $stmt->execute();
        return $stmt->fetch();
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

    public function update($brandId, $newName) {
        $stmt = $this->_conn->getConnection()->prepare('
          UPDATE brand
            SET brandName = :newName
          WHERE id = :brandId');
        $stmt->bindParam(':brandId', $brandId, PDO::PARAM_INT);
        $stmt->bindParam(':newName', $newName, PDO::PARAM_STR, 60);
        return $stmt->execute();
    }

    public function delete($brandId) {
        $stmt = $this->_conn->getConnection()->prepare('
        DELETE FROM brand WHERE id = :brandId');
        $stmt->bindParam(':brandId', $brandId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}