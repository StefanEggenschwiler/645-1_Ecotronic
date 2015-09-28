<?php

class MySqlConnector {

    const HOST = "127.0.0.1";
    const PORT = "3306";
    const DATABASE = "c645_1_ecotronic";
    const USER = "c645_1";
    const PWD = "c645_1";

    private $_connection;

    public function __construct() {
        try {
            $this->_connection = new mysqli(self::HOST, self::USER, self::PWD, self::DATABASE);

            //$this->_connection = new PDO ( 'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE, self::USER, self::PWD );
        } catch ( PDOException $e ) {
            die ( 'Connection failed: ' . $e->getMessage () );
        }
    }

    public function getConnection(){
        if(!isset($this->_connection) ||
            $this->_connection == null){
            new MySqlConnector();
        }
        return $this->_connection;
    }

    public function selectDB($query){
        //	var_dump($test);
        //	print_r($this->_connection->errorInfo()); exit;
        $result = $this->getConnection()->query($query)
        or die(print_r($this->getConnection()->errorInfo(), true));
        return $result;
    }

    public function executeQuery($query){
        $result = $this->getConnection()->exec($query);
        $e = $this->getConnection()->errorInfo();
        if($e[1]!=null) {
            if ($e[1] == 1062)
                return 'doublon';
            else
                die(print_r($this->getConnection()->errorInfo(),true));
        }
        return $result;
    }
}
?>