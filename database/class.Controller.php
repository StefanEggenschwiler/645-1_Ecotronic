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

/*
 * This class is used as abstraction layer between the different DAOs and the view.
 *
 * It calls the functions of the DAOs and returns either the unchanged result set or
 * it formats the result and produces HTML code. (Used for some functionality in the index.php)
 */
class Controller {
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
    public function createDevice($selectTypeName, $selectBrandName, $selectEfficiencyClassName, $imageURL, $controller, $price,
                                 $energyPrice, $energyConsumption, $serialNumber, $productionYear, $lifespan, $manufacturerLink,
                                 $shopLink) {
        return $this->deviceDao->create($selectTypeName, $selectBrandName, $selectEfficiencyClassName, $imageURL, $controller,
            $price, $energyPrice, $energyConsumption, $serialNumber, $productionYear, $lifespan, $manufacturerLink, $shopLink);
    }

    public function getAllDevices() {
        return $this->deviceDao->getAll();
    }

    public function getDevicesByFilter($type = null, $brands = null, $efficiencyClasses = null, $priceHigh = null) {
        return $this->deviceDao->getByFilter($type, $brands, $efficiencyClasses, $priceHigh);
    }

    public function getDevicesByModel($controller) {
        return $this->deviceDao->getByModel($controller);
    }

    public function getDevicesBySerialNumber($serialNumber){
        return $this->deviceDao->getBySerialNumber($serialNumber);
    }

    public function updateDevice($deviceId, $columnName, $newValue, $foreignTable = null) {
        $tmpValue = null;
        if (is_null($foreignTable)) {
            return $this->deviceDao->update($deviceId, $columnName, $newValue);
        } else {
            switch($columnName) {
                case 'typeId':
                    $tmpValue = $this->typeDao->getIdByName($newValue);
                    return $this->deviceDao->update($deviceId, $columnName, $tmpValue[0]);
                    break;
                case 'brandId':
                    $tmpValue = $this->brandDao->getIdByName($newValue);
                    return $this->deviceDao->update($deviceId, $columnName, $tmpValue[0]);
                    break;
                case 'efficiencyClassId':
                    $tmpValue = $this->efficiencyClassDao->getIdByName($newValue);
                    return $this->deviceDao->update($deviceId, $columnName, $tmpValue[0]);
                    break;
            }
        }
        return false;
    }

    public function deleteDevice($deviceId) {
        return $this->deviceDao->delete($deviceId);
    }

    public function compareDevices($oldSerialNumber, $compareDevices) {
        $oldDevice = array();
        if($oldSerialNumber == 'MY-DEVICE'){
            foreach($compareDevices as $value){
                if($value->getSerialNumber() == $oldSerialNumber){
                    $oldDevice[0] = $value;
                }
            }
        }else{
            $oldDevice = $this->deviceDao->getBySerialNumber($oldSerialNumber);
        }

        $pos = array_search($oldDevice[0], $compareDevices);
        unset($compareDevices[$pos]);
        array_values($compareDevices);

        $handle = fopen($_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/formula.txt', "r");
        if($handle) {
            while (($line = fgets($handle)) !== false) {
                $variables[] = explode('=',$line);
            }
            fclose($handle);
        } else {
            return false;
        }

        // DiscountPrice;NormalPrice
        if(count($variables) == 2) {
            foreach($compareDevices as $value) {
                $discount = ($oldDevice[0]->getEnergyConsumption() - $value->getEnergyConsumption()) *
                    ($value->getLifeSpan() - $oldDevice[0]->getLifeSpan()) * $variables[0][1];
                if ($discount <= $variables[1][1]) {
                    if($discount > 0) {
                        $value->setPrice($value->getPrice()*(1-$discount).';'.$value->getPrice());
                    } else {
                        $value->setPrice(';'.$value->getPrice());
                    }
                } else {
                    $value->setPrice($value->getPrice()*(1-$variables[1][1]).';'.$value->getPrice());
                }
            }
            $oldDevice[0]->setPrice(";".$oldDevice[0]->getPrice());
            array_unshift($compareDevices, $oldDevice[0]);
            return $compareDevices;
        } else {
            return false;
        }
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

    public function updateType($typeId, $newName) {
        return $this->typeDao->update($typeId, $newName);
    }

    public function deleteType($typeId) {
        return $this->typeDao->delete($typeId);
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

    public function updateBrand($brandId, $newName) {
        return $this->brandDao->update($brandId, $newName);
    }

    public function deleteBrand($brandId) {
        return $this->brandDao->delete($brandId);
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

    public function updateEfficiencyClass($efficiencyClassId, $newName) {
        return $this->efficiencyClassDao->update($efficiencyClassId, $newName);
    }

    public function deleteEfficiencyClass($efficiencyClassId) {
        return $this->efficiencyClassDao->delete($efficiencyClassId);
    }

    // DISPLAY
    public function displayDevicesWithFilters($category, $brands = null, $efficiencyClass = null, $price = null, $selectedSort=null){
        $this->showedItems = $this->deviceDao->getByFilter($category, $brands, $efficiencyClass, $price);
        $this->showedItems = $this->orderShowedItems($this->showedItems, $selectedSort);
        $this->displayDevicesForm($this->showedItems);
    }

    public function displayDevicesWithoutFilters($category, $selectedSort=null){
        $this->showedItems = $this->deviceDao->getByFilter($category);
        $this->showedItems = $this->orderShowedItems($this->showedItems, $selectedSort);
        $this->displayDevicesForm($this->showedItems);

    }

    //sort items based on selected sort
    public function orderShowedItems($showedItems, $selectedSort){
        switch($selectedSort)
        {
            case "AA" :
                usort($showedItems, function($a, $b)
                {
                    return strcmp($a->getModel(), $b->getModel());
                });
                break;
            case "DA" :
                usort($showedItems, function($a, $b)
                {
                    return strcmp($b->getModel(), $a->getModel());
                });
                break;
            case "AP" :
                usort($showedItems, function($a, $b)
                {
                    return strcmp($a->getPrice(), $b->getPrice());
                });
                break;
            case "DP" :
                usort($showedItems, function($a, $b)
                {
                    return strcmp($b->getPrice(), $a->getPrice());
                });
                break;
            case "AC" :
                usort($showedItems, function($a, $b)
                {
                    return strcmp($a->getEfficiencyClassName(), $b->getEfficiencyClassName());
                });
                break;
            case "DC" :
                usort($showedItems, function($a, $b)
                {
                    return strcmp($b->getEfficiencyClassName(), $a->getEfficiencyClassName());
                });
                break;
        }
        return $showedItems;
    }

    public function displayDevicesForm($showedItems){
        foreach($showedItems as $value){
            echo "<li><table><tr><a href='#'>";
            echo "<td><img src=";
            echo $value->getImage();
            echo "></td><td>";
            echo $value->getBrandName()."<br />";
            echo $value->getModel()."<br />";
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

    //get options for sortdropdownlist
    public function getDropdownlistSort($selectedSort, $translate){
        $orderType = array('Ascending Price'=>'AP', 'Descending Price'=>'DP', 'Ascending Alphabetical'=>'AA', 'Descending Alphabetical'=>'DA', 'Ascending Classification'=>'AC', 'Descending Classification'=>'DC');

        while(list($k,$v)=each($orderType)){
            if($selectedSort == $v){
                echo '<option value="'.$v.'" selected>';
                echo $translate->__($k);
                echo '</option>';
            }else{
                echo '<option value="'.$v.'">';
                echo $translate->__($k);
                echo '</option>';
            }
        }
    }

    //get options for categorydropdownlist
    public function getDropdownlistCategory($translate){
        $types = $this->getAllTypes();
        foreach($types as $value){
            echo '<option value="'.$value->getId().'">';
            echo $translate->__($value->getTypeName());
            echo '</option>';
        }

        return $types;
    }
}