<?php

class MySqlConnector {

    const HOST = "127.0.0.1";
    const PORT = "3306";
    const DATABASE = "c645_1_ecotronic";
    const USER = "c645_1";
    const PWD = "c645_1";

    private $_connection;

    public function __construct() {
        $this->_connection = new mysqli(self::HOST, self::USER, self::PWD, self::DATABASE);
        if($this->_connection->connect_errno > 0){
            die('Unable to connect to database [' . $this->_connection->connect_error . ']');
        }
    }

    public function getConnection(){
        if(!isset($this->_connection) ||
            $this->_connection == null){
            new MySqlConnector();
        }
        return $this->_connection;
    }

    public function executeQuery($query){
        $result = $this->getConnection()->query($query)
        or die('Unable to connect to database [' . print_r($this->getConnection()->errno . ']', true));
        return $result;
    }
}
?>