<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Type.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Brand.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.EfficiencyClass.php';

class Device {

    // Fields
    private $id;
    private $typeId;
    private $typeName;
    private $brandId;
    private $brandName;
    private $efficiencyClassId;
    private $className;
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

    public function __toString()
    {
        return $this->serialNumber;
    }

    // Getter
    public function getId() {
        return $this->id;
    }
    public function getTypeId() {
        return $this->typeId;
    }
    public function getTypeName() {
        return htmlentities(utf8_encode($this->typeName), ENT_QUOTES, 'UTF-8');
    }
    public function getEfficiencyClassId() {
        return $this->efficiencyClassId;
    }
    public function getEfficiencyClassName() {
        return htmlentities(utf8_encode($this->className), ENT_QUOTES, 'UTF-8');
    }
    public function getBrandId() {
        return $this->brandId;
    }
    public function getBrandName() {
        return htmlentities(utf8_encode($this->brandName), ENT_QUOTES, 'UTF-8');
    }
    public function getDiscountId() {
        return $this->discountId;
    }
    public function getImage() {
        return htmlentities(utf8_encode($this->image), ENT_QUOTES, 'UTF-8');
    }
    public function getModel() {
        return htmlentities(utf8_encode($this->model), ENT_QUOTES, 'UTF-8');
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
        return htmlentities(utf8_encode($this->serialNumber), ENT_QUOTES, 'UTF-8');
    }
    public function getProductionYear() {
        return $this->productionYear;
    }
    public function getManufacturerLink() {
        return htmlentities(utf8_encode($this->manufacturerLink), ENT_QUOTES, 'UTF-8');
    }
    public function getShopLink() {
        return htmlentities(utf8_encode($this->shopLink), ENT_QUOTES, 'UTF-8');
    }

    // Setter
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