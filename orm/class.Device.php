<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';

class Device
{
    // Database Connection
    private $_conn;

    // Fields
    public $id = "";
    public $typeId = "";
    public $brandId = "";
    public $efficiencyClassId = "";
    public $discountId = "";
    public $image = "";
    public $model = "";
    public $price = "";
    public $energyPrice = "";
    public $energyConsumption = "";
    public $serialNumber = "";
    public $productionYear = "";
    public $manufacturerLink = "";
    public $shopLink = "";

    public function __construct()
    {
        $this->_conn = new PdoConnector();
    }

    public function getAll() {
        $stmt = $this->_conn->getConnection()->query('
        SELECT * FROM device');
        $stmt->setFetchMode(PDO::FETCH_INTO, new Device);
        return $stmt->fetchAll();
    }

    public function getByFilter($type, $brand = null, $efficiencyClass = null, $priceLow = null, $priceHigh = null, $energyConsumptionLow = null, $energyConsumptionHigh = null) {
        $sql = sprintf('SELECT * FROM device WHERE typeId = (SELECT id FROM type WHERE typeName = :type) %s %s %s %s %s %s %s %s ;',
            !is_null($brand)   ? 'AND brandId = (SELECT id FROM brand WHERE brandName = :brand)'   : null,
            !is_null($efficiencyClass) ? 'AND efficiencyClassId = (SELECT id FROM efficiencyclass WHERE className = :efficiencyClass' : null,
            !is_null($priceLow) &&  is_null($priceHigh) ? 'AND price BETWEEN :priceLow AND 100000' : null,
             is_null($priceLow) && !is_null($priceHigh) ? 'AND price BETWEEN 0 AND :priceHigh' : null,
            !is_null($priceLow) && !is_null($priceHigh) ? 'AND price BETWEEN :priceLow AND :priceHigh' : null,
            !is_null($energyConsumptionLow) &&  is_null($energyConsumptionHigh) ? 'AND energyConsumption BETWEEN :energyConsumptionLow AND 100000' : null,
             is_null($energyConsumptionLow) && !is_null($energyConsumptionHigh) ? 'AND energyConsumption BETWEEN 0 AND :energyConsumptionHigh' : null,
            !is_null($energyConsumptionLow) && !is_null($energyConsumptionHigh) ? 'AND energyConsumption BETWEEN :energyConsumptionLow AND :energyConsumptionHigh' : null);

        $stmt = $this->_conn->getConnection()->prepare($sql);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR, 50);
        if(!is_null($brand)) {
            $stmt->bindParam(':brand', $brand, PDO::PARAM_STR, 60);
        }
        if(!is_null($efficiencyClass)) {
            $stmt->bindParam(':efficiencyClass', $efficiencyClass, PDO::PARAM_STR, 50);
        }
        if(!is_null($priceLow)) {
            $stmt->bindParam(':priceLow', $priceLow, PDO::PARAM_STR, 20);
        }
        if(!is_null($priceHigh)) {
            $stmt->bindParam(':priceHigh', $priceHigh, PDO::PARAM_STR, 20);
        }
        if(!is_null($energyConsumptionLow)) {
            $stmt->bindParam(':energyConsumptionLow', $energyConsumptionLow, PDO::PARAM_STR, 20);
        }
        if(!is_null($energyConsumptionHigh)) {
            $stmt->bindParam(':energyConsumptionHigh', $energyConsumptionHigh, PDO::PARAM_STR, 20);
        }
        $stmt->setFetchMode(PDO::FETCH_INTO, new Device);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function create($type, $brand, $efficiencyClass, $imageUrl, $model, $price, $energyPrice,
                           $energyConsumption, $serialNumber, $productionYear, $manufacturerLink, $shopLink) {

        $query = "INSERT INTO device (typeid, brandid, efficiencyClassId, imageURL, model, price, energyPrice,
                                 energyConsumption, serialNumber, productionYear, manufacturerLink, shopLink)
                                 VALUES (
								 SELECT id from type WHERE typeName = :type,
								 SELECT id from brand WHERE brandName = :brand,
								 SELECT id from efficiencyclass WHERE className = :efficiencyClass,
								 :imageUrl,
								 :model,
								 :price,
								 :energyPrice,
								 :energyConsumption,
								 :serialNumber,
								 :productionYear,
								 :manufacturerLink,
								 :shopLink
								 )";
        $stmt = $this->_conn->getConnection()->prepare($query);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR, 50);
        $stmt->bindParam(':brand', $brand, PDO::PARAM_STR, 60);
        $stmt->bindParam(':efficiencyClass', $efficiencyClass, PDO::PARAM_STR, 50);
        $stmt->bindParam(':imageUrl', $imageUrl, PDO::PARAM_STR, 300);
        $stmt->bindParam(':model', $model, PDO::PARAM_STR, 200);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR, 20);
        $stmt->bindParam(':energyPrice', $energyPrice, PDO::PARAM_STR, 20);
        $stmt->bindParam(':energyConsumption', $energyConsumption, PDO::PARAM_STR, 20);
        $stmt->bindParam(':serialNumber', $serialNumber, PDO::PARAM_STR, 200);
        $stmt->bindParam(':productionYear', $productionYear, PDO::PARAM_INT);
        $stmt->bindParam(':manufacturerLink', $manufacturerLink, PDO::PARAM_STR, 300);
        $stmt->bindParam(':shopLink', $shopLink, PDO::PARAM_STR, 300);

        return $stmt->execute();
    }

    public function update() {

    }

    public function delete($deviceId) {

    }
}