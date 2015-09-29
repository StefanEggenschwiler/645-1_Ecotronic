<?php
/**
 * Created by PhpStorm.
 * User: Stefan
 * Date: 28-Sep-15
 * Time: 11:21
 */
class EfficiencyClass

{
    private $id;
    private $className;

    public function __construct($id, $className)
    {
        $this->id = $id;
        $this->className = $className;
    }

    //getter
    public function getId(){
        return $this->id;
    }
    public function getClassName(){
        return $this->className;
    }

    //setter
    public function setClassName($className){
        $this->className = $className;
    }
}