<?php
class Device {
    private $id;
    private $typeId;
    private $efficiencyClassId;
    private $brandId;
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
    private $brandName;
    private $typeName;
    private $className;
    public function __construct($id, $typeId, $efficiencyClassId, $brandId, $image, $model, $price, $energyPrice, $energyConsumption, $serialNumber, $productionYear, $manufacturerLink, $shopLink, $discount, $discountStart, $discountEnd, $brandName, $typeName, $className) {
        $this->id = $id;
        $this->typeId = $typeId;
        $this->efficiencyClassId = $efficiencyClassId;
        $this->brandId = $brandId;
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
        $this->brandName = $brandName;
        $this->typeName = $typeName;
        $this->className = $className;
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
    public function getBrandName() {
        return $this->brandName;
    }
    public function getTypeName() {
        return $this->typeName;
    }
    public function getClassName() {
        return $this->className;
    }

    // setter
    public function setId($Id) {
        $this->id = $Id;
    }
    public function setTypeId($typeId) {
        $this->id = $typeId;
    }
    public function setEfficiencyClassId($efficiencyClassId) {
        $this->efficiencyClassId = $efficiencyClassId;
    }
    public function setBrandId($brandId) {
        $this->brandId = $brandId;
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
    public function setBrandName($brandName) {
        $this->brandName = $brandName;
    }
    public function setTypeName($typeName) {
        $this->typeName = $typeName;
    }
    public function setClassName($className) {
        $this->className = $className;
    }
}