<?php
include_once 'header.inc';

require_once 'database/class.Model.php';
require_once 'dto/class.Type.php';
require_once 'dto/class.Brand.php';
require_once 'dto/class.Device.php';
require_once 'dto/class.EfficiencyClass.php';

if(!isset($_SESSION['comparedDevices'])){
    $_SESSION['comparedDevices'] = array();
}


$model = new Model();
$types = $model->getAllTypes();
$brands = $model->getAllBrands();
$efficiencyClasses = $model->getAllEfficiencyClasses();
$consumptions = array();
$selectedCategoryChoice = null;
$selectedBrandChoice = array();
$selectedEfficiencyClassChoice = array();
$selectedPriceChoice = 0;
$searchBarContent = null;

$showedDevices = array();
$comparedDevices = array();


if(isset($_POST['cat'])) {
    $selectedCategoryChoice = $_POST['cat'];
    $brands = $model->getBrandsByType($selectedCategoryChoice);
    $efficiencyClasses = $model->getEfficiencyClassesByType($selectedCategoryChoice);
}
foreach($brands as $value){
    if (isset($_POST[$value->getBrandName()])) {
        $selectedBrandChoice[] = $value->getBrandName();
    }
}

foreach($efficiencyClasses as $value){
    if (isset($_POST[$value->getClassName()])) {
        $selectedEfficiencyClassChoice[] = $value->getClassName();
    }
}

if (isset($_POST['priceOfSlider'])){
    $selectedPriceChoice = $_POST['priceOfSlider'];
}

if(isset($_POST['searchBar'])){
    $searchBarContent = ($_POST['searchBar']);

}

?>
    <!-- wrapper contains menu + showedItems-->
    <div class="wrapper">
        <!-- left menu filters-->

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
                <?php
                foreach($efficiencyClasses as $value){
                    echo "<div class='submenu'><label href='#'> <input type='checkbox' ";
                    echo "name='".$value->getClassName()."' value='".$value->getClassName()."'";
                    foreach($selectedEfficiencyClassChoice as $key){
                        if($key == $value->getClassName()){
                            echo 'checked';
                        }
                    }
                    echo ">";
                    echo $value->getClassName()."</br>";
                    echo "</label></div>";
                } ?>
            </div>

            <div class="menu" id="menu4" onclick="displayMenu(this)">
                <label href="#"><?php $translate->__('Price')?></label>
            </div>
            <div id="submenu4" style="display:none">
                <div class='submenu'>
                    <label style="text-align:center"><?php $translate->__('Max')?></br><input type="range" name="priceOfSlider" min="0" max="<?php echo $model->getMaxPriceOfDevices($model->getDevicesByFilter($selectedCategoryChoice))+100; ?>" step="100" value="0" oninput="displayPrice(value)" onchange="displayPrice(value)"></br><span id="range">0</span> </label>
                </div>
            </div>

            <label href="#" id="show"><input id="searchButton" type="submit" name="searchButton" value="<?php $translate->__('Show')?>"></label>

        </div>

        <!-- right div to show compared devices-->
        <div class="rightComparator">
            <?php
            foreach($comparedDevices as $value){
                echo "<table>";
                echo "<tr>";
                echo "<th>XXX</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>XXX</td>";
                echo "<td>XXX</td>";
                echo "</tr>";
                echo "</table>";
            }

            ?>
            <label href="#" id="compare"><input id="compareButton" type="submit" name="compareButton" value="<?php $translate->__('Compare')?>"></label>
        </div>

        <!-- Center div to show the selected devices-->
        <div class="centerShowItems">
            <ul>
                <?php

                if($selectedCategoryChoice != null || $searchBarContent !=null) {
                    if($selectedBrandChoice != null || $selectedEfficiencyClassChoice != null || $selectedPriceChoice != null){

                        $model->displayDevicesWithFilters($selectedCategoryChoice, $selectedBrandChoice, $selectedEfficiencyClassChoice, $selectedPriceChoice);
                        $showedDevices = $model->getDevicesByFilter($selectedCategoryChoice, $selectedBrandChoice, $selectedEfficiencyClassChoice, $selectedPriceChoice);
                    }else {
                        $model->displayDevicesWithoutFilters($selectedCategoryChoice);
                        $showedDevices = $model->getDevicesByFilter($selectedCategoryChoice);

                    }
                    if($searchBarContent!=null){
                        $myDevices = $model->getDevicesByModel($searchBarContent);
                        $model->displayDevicesForm($myDevices);
                    }
                }

                if($showedDevices !=null){
                    $serialNumbersArray = array();

                    foreach($showedDevices as $value){
                       $serialNumbersArray[] = $value->getSerialNumber();
                    }

                    foreach($showedDevices as $value)
                    {
                        $serialNumber = $value->getSerialNumber();

                        if(isset($_POST[$serialNumber])){
                            $myDevices = $_SESSION['comparedDevices'];

                            if(in_array($serialNumber,$serialNumbersArray, true)){
                                $myDevices[] = $value;
                                $_SESSION['comparedDevices'] = $myDevices;
                            }
                        }
                    }
                    var_dump($serialNumbersArray);
                    var_dump($_SESSION['comparedDevices']);
                }


                ?>
            </ul>
        </div>
        <!-- end of the form for the whol page, begins int the header.inc-->
        </form>
    </div>

<?php
include_once 'footer.inc';
?>