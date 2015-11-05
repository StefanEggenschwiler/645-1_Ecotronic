<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Discount.php';

/*
 * This class is used as DataAccessObject for the discount table in the database.
 * It's not yet fully implemented since we dropped the feature of adding additional
 * discounts specified by the admin due to time issues.
 * Prepared statements are used wherever possible.
 *
 * Since we use PDO for the database connection we fetch the result set of the SELECT
 * statements into an array of DTO objects of the specified type and use the array as
 * the functions return value. Source: http://php.net/manual/en/pdostatement.fetchobject.php
 */
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

    public function delete($discountId) {
        $stmt = $this->_conn->getConnection()->prepare('
        DELETE FROM discount WHERE id = :discountId');
        $stmt->bindParam(':discountId', $discountId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}