<?php
include_once 'header.inc';
require_once 'database/class.Model.php';
require_once 'dto/class.Type.php';
require_once 'dto/class.Brand.php';
require_once 'dto/class.Device.php';
require_once 'dto/class.EfficiencyClass.php';
/**
 * Created by PhpStorm.
 * User: Muhamed
 * Date: 25.09.2015
 * Time: 09:33
 */
$model = new Model();
$types = $model->getTypes();
$brands = $model->getBrands();
$efficiencyClasses = $model->getEfficiencyClasses();
$consumptions = array();
$showedItems = $model->getBrands();

?>

    <div class="wrapper">
    <nav class="vertical">
        <ul>
            <li>
                <a><?php $translate->__('Category')?></a>
                <div>
                    <ul>
                        <?php foreach($types as $key=>$value){
                            echo "<li id='$key'><a>";
                            echo $translate->__($value->getTypeName());
                            echo "</a></li>";
                        } ?>
                    </ul>
                </div>
            </li>
            <li>
                <a><?php $translate->__('Brand')?></a>
                <div>
                    <ul>
                        <?php foreach($brands as $key=>$value){
                            echo "<li id='$key'><a>";
                            echo  $value->getBrandName();
                            echo "</a></li>";
                        } ?>
                    </ul>
                </div>
            </li>
            <li>
                <a><?php $translate->__('Classification')?></a>
                <div>
                    <ul>
                        <?php foreach($efficiencyClasses as $key=>$value){
                            echo "<li id='$key'><a>";
                            echo $value->getClassName();
                            echo "</a></li>";
                        } ?>
                    </ul>
                </div>
            </li>
            <li>
                <a><?php $translate->__('kWh/year')?></a>
                <div>
                    <ul>

                    </ul>
                </div>
            </li>
            <li>
                <a><?php $translate->__('Price')?></a>
                <div>
                    <ul>

                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    <div class="centerShowItems">
        <ul>
            <?php foreach($showedItems as $key=>$value){
                echo "<li id='$key'><a href='#'>";
                echo $value->getBrandName();
                echo "</a></li>";
            } ?>
        </ul>
    </div>
<?php
include_once 'footer.inc';
?>