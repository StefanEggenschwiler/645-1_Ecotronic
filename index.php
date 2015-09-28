<?php
include_once 'header.inc';
require_once 'database/class.MySqlManager.php';
require_once 'database/class.Type.php';
require_once 'database/class.Brand.php';
require_once 'database/class.Device.php';
require_once 'database/class.EfficiencyClass.php';
/**
 * Created by PhpStorm.
 * User: Muhamed
 * Date: 25.09.2015
 * Time: 09:33
 */
$mySqlManager = new MySqlManager();
$types = $mySqlManager->getTypes();
$brands = $mySqlManager->getBrands();
$efficiencyClasses = $mySqlManager->getEfficiencyClasses();
$consumptions = array();

?>

<div class="wrapper">
    <nav class="vertical">
        <ul>
            <li>
                <a href="#"><?php $translate->__('Category')?></a>
                <div>
                    <ul>
                        <?php foreach($types as $value){
                            echo "<li><a href='#'>";
                            echo $translate->__($value->getTypeName());
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
                            echo $value->getBrandName();
                            echo "</a></li>";
                        } ?>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#"><?php $translate->__('Classification')?></a>
                <div>
                    <ul>
                        <?php foreach($efficiencyClasses as $value){
                            echo "<li><a href='#'>";
                            echo $translate->__($value->getClassName());
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