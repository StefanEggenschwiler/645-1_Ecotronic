<?php

class Type {
    // Fields
    private $id;
    private $typeName;

    // Getter
    public function getId(){
        return $this->id;
    }
    public function getTypeName(){
        return $this->typeName;
    }

    // Setter
    public function setTypeName($typeName){
        $this->typeName = $typeName;
    }
}