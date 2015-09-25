<?php
include_once 'header.inc';
/**
 * Created by PhpStorm.
 * User: Muhamed
 * Date: 25.09.2015
 * Time: 09:33
 */
$categories = array("Vacuum cleaner", "Kettle", "Freezer", "Chest freezer", "Oven", "Humidifier", "Washing dish", "Dish washer", "Coffee machine", "Baking trays", "Isolated freezer", "Dryer", "Extraction hood");
$brands = array();
$classifications = array("A+++", "A++","A+", "A", "B", "C", "D");
$consumptions = array();

?>
<ul>
    <li><?php $translate->__('Category')?>
        <ul>
            <?php foreach($categories as $value){
                echo "<li>";
                echo $translate->__($value);
                echo "</li>";
            } ?>
        </ul>
    </li>
    <li><?php $translate->__('Brand')?>
        <ul>
            <?php foreach($brands as $value){
                echo "<li>";
                echo $translate->__($value);
                echo "</li>";
            } ?>
        </ul>
    </li>
    <li><?php $translate->__('Classification')?>
        <ul>
            <?php foreach($classifications as $value){
                echo "<li>";
                echo $translate->__($value);
                echo "</li>";
            } ?>
        </ul>
    </li>
    <li><?php $translate->__('kWh/year')?>
        <ul>
            <?php foreach($classifications as $value){
                echo "<li>";
                echo $translate->__($value);
                echo "</li>";
            } ?>
        </ul>
    </li>
    <li><?php $translate->__('Price')?>
    </li>
</ul>
<?php
include_once 'footer.inc';
?>