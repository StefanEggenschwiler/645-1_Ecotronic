<?php
include_once 'headerIndex.inc';
require_once 'dto/class.Device.php';
?>
<table class="comparisonTable">
    <tr>
        <td><?php $translate->__('Your old device')?>-></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td><input type="radio" name="dev" value="';
            echo $value->getSerialNumber().'"';
                if($value->getSerialNumber() == $_SESSION['myOldDevice']){
                    echo ' checked';
                }
            echo '></td>';
        }
        ?>
    </tr>
    <tr>
        <td></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td><img src="'.$value->getImage().'"</td>';
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Brand')?></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getBrandName().'</td>';
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Model')?></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getModel().'</td>';
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Classification')?></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getEfficiencyClassName().'</td>';
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Price')?></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getPrice().'</td>';
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Energy price')?></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getEnergyPrice().'</td>';
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Energy consumption')?></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getEnergyConsumption().'</td>';
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Production year')?></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getProductionYear().'</td>';
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Serial number')?></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getSerialNumber().'</td>';
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Manufacturer link')?></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td><a href="';
            echo $value->getManufacturerLink();
            echo '" >';
            echo $translate->__('Link');
            echo '</a></td>';
        }
        ?>
    </tr>
    <tr>
        <td><?php $translate->__('Shop link')?></td>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td><a href="';
            echo $value->getShopLink();
            echo '" >';
            echo $translate->__('Link');
            echo '</a></td>';
        }
        ?>
    </tr>
</table>
<?php
include_once 'footer.inc';
?>



