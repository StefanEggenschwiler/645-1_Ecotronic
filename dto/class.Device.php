<?php
include_once 'dto/class.Type.php';
include_once 'dto/class.Brand.php';
include_once 'dto/class.EfficiencyClass.php';

class Device {
    private $id;
    private $typeId;
    private $brandId;
    private $efficiencyClassId;
    private $discountId;
    private $image;
    private $model;
    private $price;
    private $energyPrice;
    private $energyConsumption;
    private $serialNumber;
    private $productionYear;
    private $manufacturerLink;
    private $shopLink;
    public function __construct($id, $typeId, $brandId, $efficiencyClassId, $discountId, $image, $model, $price, $energyPrice, $energyConsumption, $serialNumber, $productionYear, $manufacturerLink, $shopLink) {
        $this->id = $id;
        $this->typeId = $typeId;
        $this->brandId = $brandId;
        $this->efficiencyClassId = $efficiencyClassId;
        $this->discountId = $discountId;
        $this->image = $image;
        $this->model = $model;
        $this->price = $price;
        $this->energyPrice = $energyPrice;
        $this->energyConsumption = $energyConsumption;
        $this->serialNumber = $serialNumber;
        $this->productionYear = $productionYear;
        $this->manufacturerLink = $manufacturerLink;
        $this->shopLink = $shopLink;
    }

    // getter
    public function getId() {
        return $this->id;
    }
    public function getTypeId() {
        return $this->typeId;
    }
    public function getEfficiencyClassId() {
        return $this->efficiencyClassId;
    }
    public function getBrandId() {
        return $this->brandId;
    }
    public function getDiscountId() {
        return $this->discountId;
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

    // setter
    public function setTypeId($typeId) {
        $this->typeId = $typeId;
    }
    public function setEfficiencyClassId($efficiencyClassId) {
        $this->efficiencyClassId = $efficiencyClassId;
    }
    public function setBrandId($brandId) {
        $this->brandId = $brandId;
    }
    public function setDiscountId($discountId) {
        $this->discountId = $discountId;
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
}