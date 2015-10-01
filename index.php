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

    <div id="menu">

    <div class="menu" id="menu1" onclick="displayMenu(this)">
        <a href="#"><?php $translate->__('Category')?></a>
    </div>
    <div id="submenu1" style="display:block">
        <?php foreach($types as $key=>$value){
            echo "<div class='submenu'>";
            echo "<a>";
            echo $translate->__($value->getTypeName())."</br>";
            echo "</a></div>";
        } ?>
    </div>

    <div class="menu" id="menu2" onclick="displayMenu(this)">
        <a href="#"><?php $translate->__('Brand')?></a>
    </div>
    <div id="submenu2" style="display:none">
        <?php foreach($brands as $key=>$value){
            echo "<div class='submenu'><a>";
            echo $translate->__($value->getBrandName())."</br>";
            echo "</a></div>";
        } ?>
    </div>



    <div class="menu" id="menu3" onclick="displayMenu(this)">
        <a href="#"><?php $translate->__('Classification')?></a>
    </div>
    <div id="submenu3" style="display:none">
        <?php foreach($efficiencyClasses as $key=>$value){
            echo "<div class='submenu'><a>";
            echo $translate->__($value->getClassName())."</br>";
            echo "</a></div>";
        } ?>
        </div>
    </div>

    <div class="menu" id="menu4" onclick="displayMenu(this)">
        <a href="#"><?php $translate->__('kwh/year')?></a>
    </div>
    <div id="submenu4" style="display:none">
        <div class='submenu'>
           Kwh
        </div>
    </div>

    <div class="menu" id="menu5" onclick="displayMenu(this)">
        <a href="#"><?php $translate->__('Price')?></a>
    </div>
    <div id="submenu5" style="display:none">
        <div class='submenu'>
           Price
        </div>
    </div>
</div>





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