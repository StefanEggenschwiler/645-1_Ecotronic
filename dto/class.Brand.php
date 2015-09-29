<?php
/**
 * Created by PhpStorm.
 * User: Stefan
 * Date: 28-Sep-15
 * Time: 11:20
 */
class Brand

{
    private $id;
    private $brandName;

    public function __construct($id, $brandName)
    {
        $this->id = $id;
        $this->brandName = $brandName;
    }

    //getter
    public function getId(){
        return $this->id;
    }
    public function getBrandName(){
        return $this->brandName;
    }

    //setter
    public function setBrandName($brandName){
        $this->brandName = $brandName;
    }
}