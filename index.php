<?php
include_once 'header.inc';

require_once 'database/class.Model.php';
require_once 'dto/class.Type.php';
require_once 'dto/class.Brand.php';
require_once 'dto/class.Device.php';
require_once 'dto/class.EfficiencyClass.php';

$model = new Model();
$types = $model->getAllTypes();
$brands = $model->getAllBrands();
$efficiencyClasses = $model->getAllEfficiencyClasses();
$consumptions = array();
$selectedCategoryChoice = null;
$selectedBrandChoice[] = null;

if(isset($_POST['cat'])) {
    $selectedCategoryChoice = $_POST['cat'];
    $brands = $model->getBrandsByType($selectedCategoryChoice);
}
foreach($brands as $value){
    if (isset($_POST[$value->getBrandName()])) {
        $selectedBrandChoice[] = $value->getBrandName();
    }
}



?>
    <!-- wrapper contains menu + showedItems-->
    <div class="wrapper">
        <!-- left menu filters-->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];
        echo $_SESSION['lang'];?>">
            <div id="menu">

                <div class="menu" id="menu1" onclick="displayMenu(this)">
                    <label href="#"><?php $translate->__('Category')?></label>
                </div>
                <div id="submenu1" style="display:block">
                    <?php $model->displayCategories($types, $selectedCategoryChoice, $translate) ?>
                </div>

                <div class="menu" id="menu2" onclick="displayMenu(this)">
                    <label href="#"> <?php $translate->__('Brand')?></label>
                </div>
                <div id="submenu2" style="display:none">
                    <?php
                    foreach($brands as $value){
                        echo "<div class='submenu'><label href='#'> <input type='checkbox' ";
                        echo "name='".$value->getBrandName()."' value='".$value->getBrandName()."'";
                        foreach($selectedBrandChoice as $key){
                            if($key == $value->getBrandName()){
                                echo 'checked';
                            }
                        }
                        echo ">";
                        echo $value->getBrandName()."</br>";
                        echo "</label></div>";
                    } ?>
                </div>



                <div class="menu" id="menu3" onclick="displayMenu(this)">
                    <label href="#"><?php $translate->__('Classification')?></label>
                </div>
                <div id="submenu3" style="display:none">
                    <?php foreach($efficiencyClasses as $value){
                        echo "<div class='submenu'><label href='#'> <input type='checkbox'>";
                        echo $value->getClassName()."</br>";
                        echo "</label></div>";
                    } ?>
                </div>

                <div class="menu" id="menu4" onclick="displayMenu(this)">
                    <label href="#"><?php $translate->__('Price')?></label>
                </div>
                <div id="submenu4" style="display:none">
                    <div class='submenu'>
                        <label style="text-align:center"><?php htmlentities($translate->__('Between'), ENT_QUOTES, 'UTF-8')?> <input size="3" type="text"> <?php htmlentities($translate->__('And'), ENT_QUOTES, 'UTF-8')?> <input size="3" type="text"></label>
                    </div>
                </div>

                <label href="#" id="show"><input id="searchButton" type="submit" name="searchButton" value="<?php $translate->__('Show')?>"></label>

            </div>

            <!-- right div to show compared devices-->
        <div class="rightComparator">
            blablablabal this is a test
        </div>
        <!-- Center div to show the selected devices-->
        <div class="centerShowItems">
            <ul>
                <?php
                if($selectedCategoryChoice != null) {
                    $model->displayDevicesWithoutFilters($selectedCategoryChoice);
                }
                ?>
            </ul>
        </div>
        </form>
    </div>

<?php
include_once 'footer.inc';
?>