<?php
/*
 * DTO for the efficiencyclass table in the database.
 */
class EfficiencyClass {
    // Fields
    private $id;
    private $className;

    // Getter
    public function getId(){
        return $this->id;
    }
    public function getClassName(){
        return htmlentities(utf8_encode($this->className), ENT_QUOTES, 'UTF-8');
    }

    // Setter
    public function setClassName($className){
        $this->className = $className;
    }
}