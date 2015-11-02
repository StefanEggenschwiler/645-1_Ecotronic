<?php
include_once 'headerIndex.inc';
require_once 'dto/class.Device.php';

$check =  false;

if(count($_SESSION['comparedDevices']) != 0){
    $check = true;
    $devices = $_SESSION['comparedDevices'];
    $devices = unserialize(serialize($devices));
    $devices = $model->compareDevices($_SESSION['myOldDevice'], $devices);
}else{
    $devices = array();
}

?>
<table class="comparisonTable">
    <tr>
        <td></td>
        <?php
        if($check){
            echo '<td>';
            echo $translate->__('Your old device');
            echo '</td>';
            for ($i= 0; $i <count($devices)-1; $i++){
                echo '<td></td>';
            }
        }

        ?>
    </tr>
    <tr>
        <td></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                echo '<td><img src="' . $value->getImage() . '"</td>';
            }
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Brand')?></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                echo '<td>' . $value->getBrandName() . '</td>';
            }
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Model')?></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                echo '<td>' . $value->getModel() . '</td>';
            }
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Classification')?></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                echo '<td>' . $value->getEfficiencyClassName() . '</td>';
            }
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Normal price')?></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                $normalPrices = array();
                //discountPrice;normalPrice
                $normalPrices = explode(";",$value->getPrice());
                echo '<td>' . $normalPrices[1] . '</td>';
            }
        }
        ?>
    </tr>
    <tr>
        <td class="discountPrice"><?php $translate->__('Discount price')?></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                $discountPrices = array();
                //discountPrice;normalPrice
                $discountPrices = explode(";",$value->getPrice());
                echo '<td class="discountPrice">' . $discountPrices[0] . '</td>';
            }
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Energy price')?></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                echo '<td>' . $value->getEnergyPrice() . '</td>';
            }
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Energy consumption')?></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                echo '<td>' . $value->getEnergyConsumption() . '</td>';
            }
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Production year')?></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                echo '<td>' . $value->getProductionYear() . '</td>';
            }
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Serial number')?></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                echo '<td>' . $value->getSerialNumber() . '</td>';
            }
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Manufacturer link')?></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                echo '<td><a href="';
                echo $value->getManufacturerLink();
                echo '" >';
                echo $translate->__('Link');
                echo '</a></td>';
            }
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Shop link')?></td>
        <?php
        if($check) {
            foreach ($devices as $value) {
                echo '<td><a href="';
                echo $value->getShopLink();
                echo '" >';
                echo $translate->__('Link');
                echo '</a></td>';
            }
        }
        ?>
    </tr>
</table>
<?php
include_once 'footer.inc';
?>



