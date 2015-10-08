<?php
require_once 'dao/class.AdminDAO.php';
require_once 'dao/class.BrandDAO.php';
require_once 'dao/class.DeviceDAO.php';
require_once 'dao/class.TypeDAO.php';
require_once 'dao/class.EfficiencyClassDAO.php';
require_once 'dto/class.Admin.php';
require_once 'dto/class.Type.php';
require_once 'dto/class.Brand.php';
require_once 'dto/class.Device.php';
require_once 'dto/class.EfficiencyClass.php';
require_once 'class.MySqlConnector.php';

class Model {

    // Fields
    private $adminDao;
    private $typeDao;
    private $brandDao;
    private $deviceDao;
    private $efficiencyClassDao;

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

    // DEVICES
    public function createDevice($selectTypeName, $selectBrandName, $selectEfficiencyClassName, $imageURL, $model, $price,
                                 $energyPrice, $energyConsumption, $serialNumber, $selectProductionYear, $manufacturerLink,
                                 $shopLink) {
        return $this->deviceDao->create($selectTypeName, $selectBrandName, $selectEfficiencyClassName, $imageURL, $model,
            $price, $energyPrice, $energyConsumption, $serialNumber, $selectProductionYear, $manufacturerLink, $shopLink);
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

    // DISPLAY
    public function displayDevicesWithFilters($category, $brands){
        $showedItems = $this->deviceDao->getByFilter($category, $brands);
        //$showedItems = $this->getDevicesByFilter($category, $brands, null, null, null, null, null);
        foreach($showedItems as $value){
            echo "<li><a href='#'>";
            echo "<img src=";
            echo $value->getImage();
            echo "></br>";
            echo $value->getModel();
            echo "</a></li>";
        }
    }

    public function displayDevicesWithoutFilters($category){
        $showedItems = $this->deviceDao->getByFilter($category);
        //$showedItems = $this->getDevicesByFilter($category, null, null, null, null, null, null);
        foreach($showedItems as $value){
            echo "<li><table><tr><a href='#'>";
            echo "<td><img src=";
            echo $value->getImage();
            echo "></td><td>";
            echo $value->getBrandId()."</br>";
            echo $value->getModel()."</br>";
            echo $value->getEfficiencyClassId();
            echo "</tr></td>";
            echo "<tr><td>";
            echo $value->getPrice()."</td><td><input type='submit'></td>";
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

}