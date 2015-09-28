<?php
/**
 * Created by PhpStorm.
 * User: Stefan
 * Date: 28-Sep-15
 * Time: 11:20
 */
class Type

{
    private $id;
    private $typeName;

    public function __construct($id, $typeName)
    {
        $this->id = $id;
        $this->typeName = $typeName;
    }

    //getter
    public function getId(){
        return $this->id;
    }
    public function getTypeName(){
        return $this->typeName;
    }

    //setter
    public function setTypeName($typeName){
        $this->typeName = $typeName;
    }
}