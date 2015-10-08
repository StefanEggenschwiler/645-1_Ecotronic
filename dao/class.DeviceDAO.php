<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.DatabaseConnector.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Device.php';

class DeviceDAO
{
    // Database Connection
    private $_conn;

    public function __construct()
    {
        $this->_conn = new PdoConnector();
    }

    public function getAll() {
        $stmt = $this->_conn->getConnection()->query('
        SELECT * FROM device');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Device');
        return $stmt->fetchAll();
    }

    public function getByFilter($type, $brands = null, $efficiencyClass = null, $priceLow = null, $priceHigh = null) {
        if(!is_null($brands)) {
            $in = "";
            foreach($brands as $k => $v)
                $in .= ':brand'.$k.',';
            $in = rtrim($in, ",");
        }
        $sql = sprintf('SELECT * FROM device WHERE typeId = (SELECT id FROM type WHERE typeName = :type) %s %s %s %s %s ;',
            !is_null($brands)   ? 'AND brandId IN (SELECT id FROM brand WHERE brandName IN ('.$in.'))'   : null,
            !is_null($efficiencyClass) ? 'AND efficiencyClassId = (SELECT id FROM efficiencyclass WHERE className = :efficiencyClass' : null,
            !is_null($priceLow) &&  is_null($priceHigh) ? 'AND price BETWEEN :priceLow AND 100000' : null,
             is_null($priceLow) && !is_null($priceHigh) ? 'AND price BETWEEN 0 AND :priceHigh' : null,
            !is_null($priceLow) && !is_null($priceHigh) ? 'AND price BETWEEN :priceLow AND :priceHigh' : null);
        $stmt = $this->_conn->getConnection()->prepare($sql);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR, 50);
        if(!is_null($brands)) {
            for($i = 0; $i<count($brands); $i++) {
                $ids = explode(',', $in);
                $stmt->bindParam($ids[$i], $brands[$i], PDO::PARAM_STR, 50);
            }
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
        echo $sql;
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Device');
        return $stmt->execute();
    }

    public function create($type, $brand, $efficiencyClass, $imageUrl, $model, $price, $energyPrice,
                           $energyConsumption, $serialNumber, $productionYear, $manufacturerLink, $shopLink) {

        $query = "INSERT INTO device (typeid, brandid, efficiencyClassId, image, model, price, energyPrice,
                                 energyConsumption, serialNumber, productionYear, manufacturerLink, shopLink)
                                 VALUES (
								 (SELECT id from type WHERE typeName = :type),
								 (SELECT id from brand WHERE brandName = :brand),
								 (SELECT id from efficiencyclass WHERE className = :efficiencyClass),
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

    public function update($deviceId, $typeId, $brandId, $efficiencyClassId, $imageUrl, $model, $price, $energyPrice,
                           $energyConsumption, $serialNumber, $productionYear, $manufacturerLink, $shopLink) {
        $stmt = $this->_conn->getConnection()->prepare('
        UPDATE device
          SET typeId = :typeId, brandId = :brandId, efficiencyClassId = :efficiencyClassId, image = :imageUrl, model = :model,
          price = :price, energyPrice = :energyPrice, energyConsumption = :energyConsumption, serialNumber = :serialNumber,
          productionYear = :productionYear, manufacturerLink = :manufacturerLink, shopLink = :shopLink
        WHERE id = :deviceId');
        $stmt->bindParam(':deviceId', $deviceId, PDO::PARAM_INT);
        $stmt->bindParam(':typeId', $typeId, PDO::PARAM_INT);
        $stmt->bindParam(':brandId', $brandId, PDO::PARAM_INT);
        $stmt->bindParam(':efficiencyClassId', $efficiencyClassId, PDO::PARAM_INT);
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

    public function delete($deviceId) {
        $stmt = $this->_conn->getConnection()->prepare('
        DELETE FROM device WHERE id = :deviceId');
        $stmt->bindParam(':deviceId', $deviceId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}