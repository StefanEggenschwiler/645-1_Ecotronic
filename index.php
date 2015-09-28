<?php
include_once 'header.inc';
require_once 'database/class.MySqlManager.php';
/**
 * Created by PhpStorm.
 * User: Muhamed
 * Date: 25.09.2015
 * Time: 09:33
 */
$mySqlManager = new MySqlManager();
$categories = array("Vacuum cleaner", "Kettle", "Freezer", "Chest freezer", "Oven", "Humidifier", "Washing dish", "Dish washer", "Coffee machine", "Baking trays", "Isolated freezer", "Dryer", "Extraction hood");
$brands = $mySqlManager->getBrandNames();
$classifications = array("A+++", "A++","A+", "A", "B", "C", "D");
$consumptions = array();

?>

<div class="wrapper">
    <nav class="vertical">
        <ul>
            <li>
                <a href="#"><?php $translate->__('Category')?></a>
                <div>
                    <ul>
                        <?php foreach($categories as $value){
                            echo "<li><a href='#'>";
                            echo $translate->__($value);
                            echo "</a></li>";
                        } ?>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#"><?php $translate->__('Brand')?></a>
                <div>
                    <ul>
                        <?php foreach($brands as $value){
                            echo "<li><a href='#'>";
                            echo $value;
                            echo "</a></li>";
                        } ?>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#"><?php $translate->__('Classification')?></a>
                <div>
                    <ul>
                        <?php foreach($classifications as $value){
                            echo "<li><a href='#'>";
                            echo $translate->__($value);
                            echo "</a></li>";
                        } ?>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#"><?php $translate->__('kWh/year')?></a>
                <div>
                    <ul>

                    </ul>
                </div>
            </li>
            <li>
                <a href="#"><?php $translate->__('Price')?></a>
                <div>
                    <ul>

                    </ul>
                </div>
            </li>
        </ul>
    </nav>
<?php
include_once 'footer.inc';
?>