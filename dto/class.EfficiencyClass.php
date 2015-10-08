<?php

class EfficiencyClass {
    // Fields
    private $id;
    private $className;

    // Getter
    public function getId(){
        return $this->id;
    }
    public function getClassName(){
        return $this->className;
    }

    // Setter
    public function setClassName($className){
        $this->className = $className;
    }
}