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
        return htmlentities(utf8_encode($this->typeName), ENT_QUOTES, 'UTF-8');
    }

    // Setter
    public function setTypeName($typeName){
        $this->typeName = $typeName;
    }
}