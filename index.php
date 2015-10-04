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
$selectedCategoryChoice = null;
$checked = '' ;



if(isset($_POST['cat'])) {

    $selectedCategoryChoice = $_POST['cat'];
    echo $selectedCategoryChoice;

}

?>
<!-- wrapper contains menu + showedItems-->
    <div class="wrapper">
    <!-- left menu filters-->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <div id="menu">

        <div class="menu" id="menu1" onclick="displayMenu(this)">
            <label href="#"><?php $translate->__('Category')?></label>
        </div>
        <div id="submenu1" style="display:block">
            <?php foreach($types as $value){
                echo "<div class='submenu'><label href='#'> <input type='radio' name='cat";
                echo "'value='" ;
                echo $value;
                echo "'>";
                echo $translate->__($value);
                echo "</label></div>";
            } ?>
        </div>

        <div class="menu" id="menu2" onclick="displayMenu(this)">
            <label href="#"> <?php $translate->__('Brand')?></label>
        </div>
        <div id="submenu2" style="display:none">
            <?php foreach($brands as $value){
                echo "<div class='submenu'><label href='#'> <input type='checkbox'>";
                echo $value."</br>";
                echo "</label></div>";
            } ?>
        </div>



        <div class="menu" id="menu3" onclick="displayMenu(this)">
            <label href="#"><?php $translate->__('Classification')?></label>
        </div>
        <div id="submenu3" style="display:none">
            <?php foreach($efficiencyClasses as $value){
                echo "<div class='submenu'><label href='#'> <input type='checkbox'>";
                echo $value."</br>";
                echo "</label></div>";
            } ?>
        </div>


        <div class="menu" id="menu4" onclick="displayMenu(this)">
            <label href="#"><?php $translate->__('kwh/year')?></label>
        </div>
        <div id="submenu4" style="display:none">
            <div class='submenu'>
                <label style="text-align:center"> EN DESSOUS DE : <input size="4" type="text"> </label>
            </div>
        </div>

        <div class="menu" id="menu5" onclick="displayMenu(this)">
            <label href="#"><?php $translate->__('Price')?></label>
        </div>
        <div id="submenu5" style="display:none">
            <div class='submenu'>
                <label style="text-align:center">DE <input size="3" type="text"> � <input size="3" type="text"></label>
            </div>
        </div>

        <label href="#" id="show" onclick='selectedCategory()' ><input id="searchButton" type="submit" name="searchButton" value="<?php $translate->__('Show')?>"></label>

    </div>
    </form>

    <!-- Center div to show the selected devices-->
    <div class="centerShowItems">
        <ul>
            <?php
            if($selectedCategoryChoice != null){
                $model->displayDevices($selectedCategoryChoice);
            }

            ?>
        </ul>
    </div>

<?php
include_once 'footer.inc';
?>