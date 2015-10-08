<?php

class Discount {
    // Fields
    private $id;
    private $startDate;
    private $endDate;
    private $discount;

    // Getter
    public function getId(){
        return $this->id;
    }
    public function getStartDate(){
        return $this->startDate;
    }
    public function getEndDate(){
        return $this->endDate;
    }
    public function getDiscount(){
        return $this->discount;
    }

    // Setter
    public function setStartDate($startDate){
        $this->startDate = $startDate;
    }
    public function setEndDate($endDate){
        $this->endDate = $endDate;
    }
    public function setDiscount($discount){
        $this->discount = $discount;
    }
}