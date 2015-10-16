<?php
include_once 'headerIndex.inc';
require_once 'dto/class.Device.php';
?>

<html>
<body>
<table>
    <tr>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getBrandName().'</td>';
        }
        ?>
    </tr>
    <tr>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getBrandName().'</td>';
        }
        ?>
    </tr>
    <tr>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getModel().'</td>';
        }
        ?>
    </tr>
    <tr>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getEfficiencyClassName().'</td>';
        }
        ?>
    </tr>
    <tr>
        <?php
        foreach ($_SESSION['comparedDevices'] as $value){
            echo '<td>'.$value->getPrice().'</td>';
        }
        ?>
    </tr>
</table>
</body>
</html>


