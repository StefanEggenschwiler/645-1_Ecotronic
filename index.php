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
            <a><?php $translate->__('Category')?></a>
        </div>
        <div id="sub1" style="display:none">
            <div class="sub">
                <a> <?php foreach($types as $key=>$value){
                        echo $translate->__($value->getTypeName());
                    } ?></a>
            </div>
        </div>

        <div class="menu" id="menu2" onclick="displayMenu(this)">
            <a><?php $translate->__('Brand')?></a>
        </div>
        <div id="sub2" style="display:none">
            <div class="sub">
                <a> <?php foreach($types as $key=>$value){
                        echo $value->getBrandName();
                    } ?></a>
            </div>
        </div>
        <div class="menu" id="menu3" onclick="displayMenu(this)">
            <a><?php $translate->__('Classification')?></a>
        </div>
        <div id="sub3" style="display:none">
            <div class="sub">
                <a> <?php foreach($types as $key=>$value){
                        echo $value->getClassName();
                    } ?></a>
            </div>
        </div>

        <div class="menu" id="menu4" onclick="displayMenu(this)">
            <a><?php $translate->__('kwh/year')?></a>
        </div>
        <div id="sub4" style="display:none">
            <div class="sub">
                <a>kwh</a>
            </div>
        </div>

        <div class="menu" id="menu5" onclick="displayMenu(this)">
            <a><?php $translate->__('Price')?></a>
        </div>
        <div id="sub5" style="display:none">
            <div class="sub">
                <a>price</a>
            </div>
        </div>

    </div>
    <div class="centerShowItems">
        <h3>Products</h3>
        <button>Price ascending</button>
        <button>Price dscending</button>
        <button>Classification ascending</button>
        <button>Classification descending</button>
        <button>Name ascending</button>
        <button>Name descending</button>


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