<?php
include_once 'database/class.Type.php';
include_once 'database/class.Brand.php';
include_once 'database/class.EfficiencyClass.php';

class Device {
    private $id;
    private $type;
    private $efficiencyClass;
    private $brand;
    private $image;
    private $model;
    private $price;
    private $energyPrice;
    private $energyConsumption;
    private $serialNumber;
    private $productionYear;
    private $manufacturerLink;
    private $shopLink;
    private $discount;
    private $discountStart;
    private $discountEnd;
    public function __construct($id, $type, $efficiencyClass, $brand, $image, $model, $price, $energyPrice, $energyConsumption, $serialNumber, $productionYear, $manufacturerLink, $shopLink, $discount, $discountStart, $discountEnd) {
        $this->id = $id;
        $this->type = $type;
        $this->efficiencyClass = $efficiencyClass;
        $this->brand = $brand;
        $this->image = $image;
        $this->model = $model;
        $this->price = $price;
        $this->energyPrice = $energyPrice;
        $this->energyConsumption = $energyConsumption;
        $this->serialNumber = $serialNumber;
        $this->productionYear = $productionYear;
        $this->manufacturerLink = $manufacturerLink;
        $this->shopLink = $shopLink;
        $this->discount = $discount;
        $this->discountStart = $discountStart;
        $this->discountEnd = $discountEnd;
    }

    // getter
    public function getId() {
        return $this->id;
    }
    public function getType() {
        return $this->type;
    }
    public function getEfficiencyClass() {
        return $this->efficiencyClass;
    }
    public function getBrand() {
        return $this->brand;
    }
    public function getImage() {
        return $this->image;
    }
    public function getModel() {
        return $this->model;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getEnergyPrice() {
        return $this->energyPrice;
    }
    public function getEnergyConsumption() {
        return $this->energyConsumption;
    }
    public function getSerialNumber() {
        return $this->serialNumber;
    }
    public function getProductionYear() {
        return $this->productionYear;
    }
    public function getManufacturerLink() {
        return $this->manufacturerLink;
    }
    public function getShopLink() {
        return $this->shopLink;
    }
    public function getDiscount() {
        return $this->discount;
    }
    public function getDiscountStart() {
        return $this->discountStart;
    }
    public function getDiscountEnd() {
        return $this->discountEnd;
    }

    // setter
    public function setType($type) {
        $this->type = $type;
    }
    public function setEfficiencyClass($efficiencyClass) {
        $this->efficiencyClass = $efficiencyClass;
    }
    public function setBrand($brand) {
        $this->brand = $brand;
    }
    public function setImage($image) {
        $this->image = $image;
    }
    public function setModel($model) {
        $this->model = $model;
    }
    public function setPrice($price) {
        $this->price = $price;
    }
    public function setEnergyPrice($energyPrice) {
        $this->energyPrice = $energyPrice;
    }
    public function setEnergyConsumption($energyConsumption) {
        $this->energyConsumption = $energyConsumption;
    }
    public function setSerialNumber($serialNumber) {
        $this->serialNumber = $serialNumber;
    }
    public function setProductionYear($productionYear) {
        $this->productionYear = $productionYear;
    }
    public function setManufacturerLink($manufacturerLink) {
        $this->manufacturerLink = $manufacturerLink;
    }
    public function setShopLink($shopLink) {
        $this->shopLink = $shopLink;
    }
    public function setDiscount($discount) {
        $this->discount = $discount;
    }
    public function setDiscountStart($discountStart) {
        $this->discountStart = $discountStart;
    }
    public function setDiscountEnd($discountEnd) {
        $this->discountEnd = $discountEnd;
    }
}