<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dao/class.AdminDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dao/class.BrandDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dao/class.DeviceDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dao/class.TypeDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dao/class.EfficiencyClassDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Admin.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Type.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Brand.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Device.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.EfficiencyClass.php';

class Model {

    // Fields
    private $adminDao;
    private $typeDao;
    private $brandDao;
    private $deviceDao;
    private $efficiencyClassDao;
    private $showedItems = array();

    public function __construct(){
        $this->adminDao = new AdminDAO();
        $this->typeDao = new TypeDAO();
        $this->brandDao = new BrandDAO();
        $this->deviceDao = new DeviceDAO();
        $this->efficiencyClassDao = new EfficiencyClassDAO();
    }

    // ADMIN
    public function checkLogin($username, $password) {
        return $this->adminDao->authenticate($username, $password);
    }

    public function createAdmin($username, $firstname, $lastname, $password) {
        return $this->adminDao->create($username, $firstname, $lastname, $password);
    }

    public function updateAdmin($username, $newFirstname, $newLastname, $newPassword) {
        return $this->adminDao->update($username, $newFirstname, $newLastname, $newPassword);
    }

    // DEVICES
    public function createDevice($selectTypeName, $selectBrandName, $selectEfficiencyClassName, $imageURL, $model, $price,
                                 $energyPrice, $energyConsumption, $serialNumber, $selectProductionYear, $manufacturerLink,
                                 $shopLink) {
        return $this->deviceDao->create($selectTypeName, $selectBrandName, $selectEfficiencyClassName, $imageURL, $model,
            $price, $energyPrice, $energyConsumption, $serialNumber, $selectProductionYear, $manufacturerLink, $shopLink);
    }

    public function getDevicesByFilter($type, $brands = null, $efficiencyClasses = null, $priceLow = null, $priceHigh = null) {
        return $this->deviceDao->getByFilter($type, $brands, $efficiencyClasses, $priceLow, $priceHigh);
    }

    public function getDevicesByModel($model) {
        return $this->deviceDao->getByModel($model);
    }

    public function getDevicesBySerialNumber($serialNumber){
        return $this->deviceDao->getBySerialNumber($serialNumber);
    }

    // TYPES
    public function getAllTypes() {
        $types = $this->typeDao->getAll();
        usort($types, function($a, $b)
        {
            return strcmp($a->getTypeName(), $b->getTypeName());
        });
        return $types;
    }

    public function createType($typeName) {
        return $this->typeDao->create($typeName);
    }

    public function updateType($oldName, $newName) {
        return $this->typeDao->update($oldName, $newName);
    }

    public function deleteType($typeName) {
        return $this->typeDao->delete($typeName);
    }

    // BRANDS
    public function getAllBrands() {
        $brands = $this->brandDao->getAll();
        usort($brands, function($a, $b)
        {
            return strcmp($a->getBrandName(), $b->getBrandName());
        });
        return $brands;
    }

    public function getBrandsByType($typeName) {
        $brands = $this->brandDao->getByType($typeName);
        usort($brands, function($a, $b)
        {
            return strcmp($a->getBrandName(), $b->getBrandName());
        });
        return $brands;
    }

    public function createBrand($brandName) {
        return $this->brandDao->create($brandName);
    }

    public function updateBrand($oldName, $newName) {
        return $this->brandDao->update($oldName, $newName);
    }

    public function deleteBrand($brandName) {
        return $this->brandDao->delete($brandName);
    }

    // EFFICIENCY CLASSES
    public function getAllEfficiencyClasses() {
        $ecs = $this->efficiencyClassDao->getAll();
        usort($ecs, function($a, $b)
        {
            return strcmp($a->getClassName(), $b->getClassName());
        });
        return $ecs;
    }

    public function getEfficiencyClassesByType($typeName) {
        $ecs = $this->efficiencyClassDao->getByType($typeName);
        usort($ecs, function($a, $b)
        {
            return strcmp($a->getClassName(), $b->getClassName());
        });
        return $ecs;
    }

    public function createEfficiencyClass($efficiencyClassName) {
        return $this->efficiencyClassDao->create($efficiencyClassName);
    }

    public function updateEfficiencyClass($oldName, $newName) {
        return $this->efficiencyClassDao->update($oldName, $newName);
    }

    public function deleteEfficiencyClass($efficiencyClassName) {
        return $this->efficiencyClassDao->delete($efficiencyClassName);
    }

    // DISPLAY
    public function displayDevicesWithFilters($category, $brands = null, $efficiencyClass = null, $price = null){
        $this->showedItems = $this->deviceDao->getByFilter($category, $brands, $efficiencyClass, $price);
        usort($this->showedItems, function($a, $b)
        {
            return strcmp($a->getPrice(), $b->getPrice());
        });
        $this->displayDevicesForm($this->showedItems);
    }

    public function displayDevicesWithoutFilters($category){
        $this->showedItems = $this->deviceDao->getByFilter($category);
        $this->displayDevicesForm($this->showedItems);

    }

    public function displayDevicesForm($showedItems){
        foreach($showedItems as $value){
            echo "<li><table><tr><a href='#'>";
            echo "<td><img src=";
            echo $value->getImage();
            echo "></td><td>";
            echo $value->getBrandName()."</br>";
            echo $value->getModel()."</br>";
            echo $value->getEfficiencyClassName();
            echo "</tr></td>";
            echo "<tr><td>";
            echo $value->getPrice()."</td><td><button id='addToCompareListButton' type='submit' value='";
            echo $value->getSerialNumber();
            echo "' name='addComparison'>+</button></td>";
            echo "</tr>";
            echo "</a></table></li>";
        }
    }

    public function displayCategories($types, $selectedCategoryChoice, $translate){
        foreach($types as $value){
            echo "<div class='submenu'><label href='#'> <input type='radio' name='cat' onchange='this.form.submit()' value='" ;
            echo $value->getTypeName();
            echo "'";
            if($value->getTypeName() == $selectedCategoryChoice)
            {
                echo " checked";
            }
            echo ">";
            echo $translate->__($value->getTypeName());
            echo "</label></div>";
        }
    }

    public function getMaxPriceOfDevices($devices) {
        $max = 0;
        foreach ($devices as $key=>$val) {
            if ($val->getPrice() > $max) {
                $max = $val->getPrice();
            }
        }
        return $max;
    }

    public function getAutoCompleteEntries() {
        $this->deviceDao->getAutoCompleteEntries();
    }
}