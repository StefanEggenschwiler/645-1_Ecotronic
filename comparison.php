<?php
include_once 'headerIndex.inc';
require_once 'dto/class.Device.php';
?>
<table>
    <tr>
        <th><?php $translate->__('Your old device')?>-></th>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<th><input type="radio" name="dev" value="';
            echo $value->getSerialNumber().'"';
                if($value->getSerialNumber() == $_SESSION['myOldDevice']){
                    echo ' checked';
                }
            echo '></th>';
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
</table>
<?php
include_once 'footer.inc';
?>



