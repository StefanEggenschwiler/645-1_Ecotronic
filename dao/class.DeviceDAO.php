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

    public function getAll()
    {
        $stmt = $this->_conn->getConnection()->query('
        SELECT device.id, device.typeId, device.brandId, device.efficiencyClassId, device.image, device.model, device.price,
               device.energyPrice, device.energyConsumption, device.serialNumber, device.productionYear, device.manufacturerLink,
               device.shopLink, brand.brandName, type.typeName, efficiencyclass.className
		FROM device, brand, type, efficiencyclass
		WHERE device.brandId = brand.id AND device.typeId = type.id AND device.efficiencyClassId = efficiencyclass.id;');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Device');
        return $stmt->fetchAll();
    }

    public function getByFilter($type, $brands = null, $efficiencyClasses = null, $priceHigh = null) {
        if(!empty($brands)) {
            $inBrand = "";
            foreach($brands as $k => $v)
                $inBrand .= ':brand'.$k.',';
            $inBrand = rtrim($inBrand, ",");
        }
        if(!empty($efficiencyClasses)) {
            $inClass = "";
            foreach($efficiencyClasses as $k => $v)
                $inClass .= ':class'.$k.',';
            $inClass = rtrim($inClass, ",");
        }
        $sql = sprintf('
        SELECT device.id, device.typeId, device.brandId, device.efficiencyClassId, device.image, device.model, device.price,
               device.energyPrice, device.energyConsumption, device.serialNumber, device.productionYear, device.manufacturerLink,
               device.shopLink, brand.brandName, type.typeName, efficiencyclass.className
        FROM device, brand, type, efficiencyclass
        WHERE
        device.brandId = brand.id AND
        device.efficiencyClassId = efficiencyclass.id AND
        device.typeId = type.id AND
        device.typeId = (SELECT id FROM type WHERE typeName = :type)  %s %s %s ;',
            !empty($brands)   ? 'AND device.brandId IN (SELECT id FROM brand WHERE brandName IN ('.$inBrand.'))'   : null,
            !empty($efficiencyClasses) ? 'AND device.efficiencyClassId IN (SELECT id FROM efficiencyclass WHERE className IN ('.$inClass.'))' : null,
            !empty($priceHigh) ? 'AND device.price BETWEEN 0 AND :priceHigh' : null);
        $stmt = $this->_conn->getConnection()->prepare($sql);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR, 50);
        if(!empty($brands)) {
            for($i = 0; $i<count($brands); $i++) {
                $ids = explode(',', $inBrand);
                $stmt->bindParam($ids[$i], $brands[$i], PDO::PARAM_STR, 50);
            }
        }
        if(!empty($efficiencyClasses)) {
            for($i = 0; $i<count($efficiencyClasses); $i++) {
                $ids = explode(',', $inClass);
                $stmt->bindParam($ids[$i], $efficiencyClasses[$i], PDO::PARAM_STR, 50);
            }
        }
        if(!empty($priceHigh)) {
            $stmt->bindParam(':priceHigh', $priceHigh, PDO::PARAM_STR, 20);
        }
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Device');
        $stmt->execute();
        return $stmt->fetchAll();
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

    public function getAutoCompleteEntries() {
        $models = array();
        $stmt = $this->_conn->getConnection()->query('
        SELECT device.model, brand.brandName FROM device, brand WHERE device.brandId = brand.id');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $models[] =  $row['brandName'].' - '.$row['model'];
        }
        var_dump(json_encode($models));
        echo json_encode($models);
    }
}