<?php
include_once 'dto/class.Admin.php';
include_once 'dto/class.Device.php';
include_once 'dto/class.Type.php';
include_once 'dto/class.Brand.php';
include_once 'dto/class.EfficiencyClass.php';
require_once 'class.MySqlConnector.php';

class Model {

    private $_conn;

    public function __construct(){
        $this->_conn = new MySqlConnector();
    }

    public function createAdmin($fname, $lname, $uname, $pwd) {
        $pwd = password_hash($pwd, PASSWORD_BCRYPT);
        $query = "INSERT INTO admin(firstname, lastname, username, password) VALUES('$fname', '$lname', '$uname', '$pwd');";
        return $this->_conn->executeQuery($query);
    }

    public function checkLogin($uname, $pwd){
        $uname = $this->_conn->getConnection()->real_escape_string($uname);
        $query = "SELECT * FROM admin WHERE username='$uname'";
        $result = $this->_conn->executeQuery($query);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if (password_verify($pwd, $row['password'])) {
                    return new Admin($row['id'], $row['firstname'], $row['lastname'],
                        $row['username']);
                } else {
                    //wrong password entered
                    die(header("location:login.php?loginFailed=true&reason=password"));
                }
            }
        } else {
            die(header("location:login.php?loginFailed=true&reason=notfound"));
        }
        return false;
    }
    // CRUD TYPES
    public function getTypes() {
        $query = "SELECT * FROM type";
        $result = $this->_conn->executeQuery($query);
        $types =  array();

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $types[] = $row["typeName"];
            }
        } else {
            echo "0 results";
        }
        return $types;
    }

    public function createType($typeName) {
        $typeName = $this->_conn->getConnection()->real_escape_string($typeName);
        $query = "INSERT INTO `type`(`id`, `typeName`) VALUES (null,'$typeName')";
        $this->_conn->executeQuery($query);
    }

    public function createDevice($type, $brand, $efficiencyClass, $imageURL, $model, $price, $energyPrice,
                                 $energyConsumption, $serialNumber, $productionYear, $manufacturerLink, $shopLink) {

        $query = "INSERT INTO device (typeid, brandid, efficiencyClassId, image, model, price, energyPrice,
                                 energyConsumption, serialNumber, productionYear, manufacturerLink, shopLink)
                                 VALUES (
								 (SELECT id from type WHERE typeName = '$type'),
								 (SELECT id from brand WHERE brandName = '$brand'),
								 (SELECT id from efficiencyclass WHERE className = '$efficiencyClass'),
								 '$imageURL',
								 '$model',
								 '$price',
								 '$energyPrice',
								 '$energyConsumption',
								 '$serialNumber',
								 '$productionYear',
								 '$manufacturerLink',
								 '$shopLink'
								 )";
        return $this->_conn->executeQuery($query);
    }

    public function updateType($typeId, $typeName) {
        $query = "UPDATE `type` SET `typeName`='$typeName' WHERE `id`= $typeId";
        $this->_conn->executeQuery($query);
    }

    public function deleteType($typeId) {
        $query = "DELETE FROM `type` WHERE `id`= $typeId";
        $this->_conn->executeQuery($query);
    }

    // CRUD EfficiencyClasses
    public function getEfficiencyClasses() {
        $query = "SELECT * FROM efficiencyclass";
        $result = $this->_conn->executeQuery($query);
        $efficiencyClasses =  array();

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $efficiencyClasses[] = $row["className"];
            }
        } else {
            echo "0 results";
        }
        return $efficiencyClasses;
    }

    public function getEfficiencyClassesByType($type) {
        $query = "
          SELECT DISTINCT effc.className
            FROM device                     dvce,
                 type                       type,
                 efficiencyClass            effc
            WHERE dvce.typeId             = type.id
              AND dvce.efficiencyClassId  = effc.id
              AND type.typeName           = '$type'";

        $result = $this->_conn->executeQuery($query);
        $efficiencyClasses =  array();

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $efficiencyClasses[] = $row["className"];
            }
        } else {
            echo "0 results";
        }
        return $efficiencyClasses;
    }

    // CRUD BRANDS
    public function getBrands(){
        $query = "SELECT * FROM brand";
        $result = $this->_conn->executeQuery($query);
        $brands =  array();

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $brands[] = $row["brandName"];
            }
        } else {
            echo "0 results";
        }
        return $brands;
    }

    public function getBrandsByType($type) {
        $query = "
          SELECT DISTINCT brnd.brandName
            FROM device           dvce,
                 type             type,
                 brand            brnd
            WHERE dvce.typeId   = type.id
              AND dvce.brandId  = brnd.id
              AND type.typeName = '$type'";

        $result = $this->_conn->executeQuery($query);
        $brands =  array();

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $brands[] = $row["brandName"];
            }
        } else {
            echo "0 results";
        }
        return $brands;
    }

    // CRUD DEVICES
    /*
     * Use coalesce for
     * Select "Column1 (Dont Want Touched)", coalesce(column2(That you want set to 0 if null),0) as column2 (give it same name as was e.g. "column2"), coalesce(column3(Instead of null set to 1),1) as column3(give it same name as was e.g. "column3")
    from "MydataTable" Where 'somedates' in ('2015-04-10','2015-04-03','2015-03-27','2015-04-17') and id = 10 order by 'somedates ';
     */
    /**
     * <p>Function used to get an array of devices<p>
     * @param $type
     * @param $brand
     * @param $efficiencyClass
     * @param $priceLow
     * @param $priceHigh
     * @param $energyConsumptionLow
     * @param $energyConsumptionHigh
     * @return array|null
     */
    public function getDevicesByFilter($type, $brand, $efficiencyClass, $priceLow, $priceHigh, $energyConsumptionLow, $energyConsumptionHigh) {
        $query = "SELECT * FROM `device` WHERE `typeId` = (SELECT `id` FROM `type` WHERE `typeName` = '$type')
        AND `brandId` = (SELECT `id` FROM `brand` WHERE `brandName` = '$brand')
        AND `efficiencyClassId` = (SELECT `id` FROM `efficiencyclass` WHERE `className` = '$efficiencyClass')
        AND `price` BETWEEN $priceLow AND $priceHigh
        AND `energyConsumption` BETWEEN $energyConsumptionLow AND $energyConsumptionHigh;";

        if(is_null($brand)) {
            $query = str_replace("AND `brandId` = (SELECT `id` FROM `brand` WHERE `brandName` = '$brand')", "", $query);
        }
        if(is_null($efficiencyClass)) {
            $query = str_replace(" AND `efficiencyClassId` = (SELECT `id` FROM `efficiencyclass` WHERE `className` = '$efficiencyClass')", "", $query);
        }
        if(is_null($priceLow) && is_null($priceHigh)) {
            $query = str_replace(" AND `price` BETWEEN $priceLow AND $priceHigh", "", $query);
        } else if(is_null($priceLow)) {
            $query = str_replace(" AND `price` BETWEEN $priceLow AND $priceHigh", " AND `price` BETWEEN 0 AND $priceHigh", $query);
        } else if(is_null($priceHigh)) {
            $query = str_replace(" AND `price` BETWEEN $priceLow AND $priceHigh", " AND `price` BETWEEN $priceLow AND 10000", $query);
        }
        if(is_null($energyConsumptionLow) && is_null($energyConsumptionHigh)) {
            $query = str_replace(" AND `energyConsumption` BETWEEN $energyConsumptionLow AND $energyConsumptionHigh", "", $query);
        } else if(is_null($energyConsumptionLow)) {
            $query = str_replace(" AND `energyConsumption` BETWEEN $energyConsumptionLow AND $energyConsumptionHigh", " AND `energyConsumption` BETWEEN 0 AND $energyConsumptionHigh", $query);
        } else if(is_null($energyConsumptionHigh)){
            $query = str_replace(" AND `energyConsumption` BETWEEN $energyConsumptionLow AND $energyConsumptionHigh", " AND `energyConsumption` BETWEEN $energyConsumptionLow AND 10000", $query);
        }
        $result = $this->_conn->executeQuery($query);
        $devices = array();

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $devices[] = new Device($row["id"], $row["typeId"], $row["brandId"], $row["efficiencyClassId"], $row["discountId"], $row["image"], $row["model"], $row["price"], $row["energyPrice"], $row["energyConsumption"], $row["serialNumber"], $row["productionYear"], $row["manufacturerLink"], $row["shopLink"]);
            }
        } else {
            echo "0 results";
            return null;
        }
        return $devices;
    }


    public function displayDevices($category){
        $showedItems = $this->getDevicesByFilter($category, null, null, null, null, null, null);
        foreach($showedItems as $value){
            echo "<li><a href='#'>";
            echo "<img src=";
            echo htmlentities($value->getImage(), ENT_QUOTES, 'iso8859-1');
            echo "></br>";
            echo $value->getModel();
            echo "</a></li>";
        }
    }

    public function displayCategories($types, $selectedCategoryChoice, $translate){
        foreach($types as $value){
            echo "<div class='submenu'><label href='#'> <input type='radio' name='cat' onchange='this.form.submit()' value='" ;
            echo $value;
            echo "'";
            if($value == $selectedCategoryChoice)
            {
                echo " checked";
            }
            echo ">";
            echo $translate->__($value);
            echo "</label></div>";
        }
    }

}