<?php

class Brand {
    // Fields
    private $id;
    private $brandName;

    // Getter
    public function getId(){
        return $this->id;
    }
    public function getBrandName(){
        return $this->brandName;
    }

    // Setter
    public function setBrandName($brandName){
        $this->brandName = $brandName;
    }
}