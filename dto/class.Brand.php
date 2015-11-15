<?php
/*
 * DTO for the brand table in the database.
 */
class Brand {
    // Fields
    private $id;
    private $brandName;

    // Getter
    public function getId(){
        return $this->id;
    }
    public function getBrandName(){
        return htmlentities(utf8_encode($this->brandName), ENT_QUOTES, 'UTF-8');
    }

    // Setter
    public function setBrandName($brandName){
        $this->brandName = $brandName;
    }
}