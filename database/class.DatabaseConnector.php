<?php

class PdoConnector {

    const HOST = "127.0.0.1";
    const PORT = "3306";
    const DATABASE = "c645_1_ecotronic";
    const USER = "c645_1";
    const PWD = "c645_1";

    private $_connection;

    public function __construct() {
        try {
            $this->_connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DATABASE, self::USER, self::PWD);
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print 'Unable to connect to database [ ' . $e->getMessage() . ' ]';
            die();
        }
    }

    public function getConnection(){
        if(!isset($this->_connection) ||
            $this->_connection == null){
            new PdoConnector();
        }
        return $this->_connection;
    }

    public function executeQuery($query){
        $result = $this->getConnection()->query($query)
        or die('Unable to connect to database [' . print_r($this->getConnection()->errno . ']', true));
        $this->getConnection()->close();
        return $result;
    }
}
?>