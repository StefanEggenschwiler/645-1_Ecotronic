<?php
include_once 'headerAdmin.inc';
include $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/functions/cryption.php';
require_once 'database/class.Model.php';
require_once 'dto/class.Device.php';

$model = new Model();
$types = $model->getAllTypes();
$brands = $model->getAllBrands();
$efficiencyClasses = $model->getAllEfficiencyClasses();
$consumptions = array();
$itemsFiltered = array();
$currentItemsArray = array();
$searchBarContent = null;
$selectedCategoryChoice = null;
$selectedBrandChoice = null;
$selectedEfficiencyClassChoice = null;
if(isset($_POST['searchBar'])){
    $searchBarContent = ($_POST['searchBar']);
}
if(isset($_POST['selectedType'])){
    $selectedCategoryChoice = ($_POST['selectedType']);
}
if(isset($_POST['selectedBrand'])){
    $selectedBrandChoice = ($_POST['selectedBrand']);
}
if(isset($_POST['selectedEfficiencyClass'])){
    $selectedEfficiencyClassChoice = ($_POST['selectedEfficiencyClass']);
}

if(!empty($selectedCategoryChoice) && empty($searchBarContent)){
    if($selectedCategoryChoice == 'Category') {
        $filterCategory = null;
    } else {
        $filterCategory = $selectedCategoryChoice;
    }
    if($selectedBrandChoice == 'Brand') {
        $filterBrand = null;
    } else {
        $filterBrand = array($selectedBrandChoice);
    }
    if($selectedEfficiencyClassChoice == 'Efficiency Class') {
        $filterEfficiencyClass = null;
    } else {
        $filterEfficiencyClass = array($selectedEfficiencyClassChoice);
    }
    $itemsFiltered = $model->getDevicesByFilter($filterCategory, $filterBrand, $filterEfficiencyClass);
    $currentItemsArray = $itemsFiltered;

} else {
    if(empty($searchBarContent)) {
        $itemsFiltered = $model->getAllDevices(); // otherwise display all objects
        $currentItemsArray = $itemsFiltered;
    } else {
        $itemsFiltered = $model->getDevicesByModel($searchBarContent);
        $currentItemsArray = $itemsFiltered;
        $selectedCategoryChoice = $itemsFiltered[0]->getTypeName();
        $selectedBrandChoice = $itemsFiltered[0]->getBrandName();
        $selectedEfficiencyClassChoice = $itemsFiltered[0]->getEfficiencyClassName();
    }
}
?>

<script type="text/javascript">
    $(function() {
        var availableTags =
            <?php

            $model->getAutoCompleteEntries();
            ?>;
        $("#searchBar").autocomplete({
            source: availableTags,
            autoFocus:true
        });
    });

    $(function(){
        // Show the text box on click
        $('body').delegate('.editable', 'click', function(){
            var ThisElement = $(this);
            ThisElement.find('span').hide();
            ThisElement.find('.gridder_input').show().focus();
        });

        // Pass and save the textbox values on blur function
        $('body').delegate('.gridder_input', 'blur', function(){
            var ThisElement = $(this);
            ThisElement.hide();
            ThisElement.prev('span').show().html($(this).val()).prop('title', $(this).val());
            var UrlToPass = 'action=updateDevice&value='+ThisElement.val()+'&crypto='+ThisElement.prop('name');
            $.ajax({
                url : 'database/ajax.php',
                type : 'POST',
                data : UrlToPass
            });
            return false;
        });

        // Same as the above blur() when user hits the 'Enter' key
        $('body').delegate('.gridder_input', 'keypress', function(e){
            if(e.keyCode == '13') {
                var ThisElement = $(this);
                ThisElement.hide();
                ThisElement.prev('span').show().html($(this).val()).prop('title', $(this).val());
            }
        });

        // Function for delete the record
        $('body').delegate('.gridder_delete', 'click', function(){
            var conf = confirm('Are you sure want to delete this device?');
            if(!conf) {
                return false;
            }
            var ThisElement = $(this);
            var UrlToPass = 'action=deleteDevice&value='+ThisElement.attr('href');
            $.ajax({
                url : 'database/ajax.php',
                type : 'POST',
                data : UrlToPass,
                success: function() {
                    location.reload();
                }
            });
            return false;
        });
    });
</script>

<div class="">
    </br>
    <div class="box">
        <div class="box-head">
            <h2 class="left">Devices</h2>
        </div>
        <div class="table">
            <div class="searchBarAdmin">
                <form method="post">
                    <input id="searchBar" type="text" name="searchBar" placeholder="Search a product..." class="ui-autocomplete-input" autocomplete="off">
                    <input type="submit" id="searchButton" name="searchButton" value="search"/>
                </form>
            </div>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <h1>FILTERS</h1>
                    </br>

                    <form name="display" method="post">
                        <select style="width: 200px" class="selectedType" id="selectedType" name="selectedType" onchange="this.form.submit();">
                            <?php
                            echo '<option>Category</option>';
                            foreach($types as $value){
                                if(!empty($selectedCategoryChoice) && $selectedCategoryChoice == $value->getTypeName()) {
                                    echo '<option selected="selected">'. $value->getTypeName().'</option>';
                                }
                                else {
                                    echo '<option>'. $value->getTypeName().'</option>';
                                }
                            } ?>
                        </select>

                        <select style="width: 200px" id="selectedBrand" name="selectedBrand" onchange="this.form.submit();">
                            <?php
                            echo '<option>Brand</option>';
                            foreach($brands as $value){
                                if(!empty($selectedBrandChoice) && $selectedBrandChoice == $value->getBrandName()) {
                                    echo '<option selected="selected">'. $value->getBrandName().'</option>';
                                }
                                else {
                                    echo '<option>'. $value->getBrandName().'</option>';
                                }
                            } ?>
                        </select>

                        <select style="width: 200px" id="selectedEfficiencyClass" name="selectedEfficiencyClass" onchange="this.form.submit();">
                            <?php
                            echo '<option>Efficiency Class</option>';
                            foreach ($efficiencyClasses as $value) {
                                if(!empty($selectedEfficiencyClassChoice) && $selectedEfficiencyClassChoice == $value->getClassName()) {
                                    echo '<option selected="selected">'. $value->getClassName().'</option>';
                                }
                                else {
                                    echo '<option>'. $value->getClassName().'</option>';
                                }
                            } ?>
                        </select>
                        <?php echo 'Result: '. count($currentItemsArray) .' device(s).'; ?>
                    </form>
                </tr>
            </table>
            <table class="as_gridder_table" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="grid_header">
                    <th></th>
                    <th>Type</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Serial number</th>
                    <th>Production Year</th>
                    <th>Life Span (in yrs)</th>
                    <th>Efficiency class</th>
                    <th>Energy price (kWh/year)</th>
                    <th>Energy consumption</th>
                    <th>Price (in CHF)</th>
                    <th>Image URL</th>
                    <th>Manufacturer link</th>
                    <th>Shop link</th>
                </tr>
                <?php
                $i = 0;
                foreach ($itemsFiltered as $items) {
                    $i = $i + 1;
                    if($i % 2 == 0) {
                        echo '<tr class="even">';
                    } else {
                        echo '<tr class="odd">';
                    }
                    echo '<td><a href="'.encrypt($items->getId()).'" class="gridder_delete"><img src="images/icons/delete.png" alt="Delete" title="Delete" /></a></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 150px">'.$items->getTypeName().'</span>
                            <select class="gridder_input select" style="width: 150px" name="'.encrypt("typeId|".$items->getId()."|".$items->getTypeId()).'">';
                    foreach($types as $value){
                        if($items->getTypeName() == $value->getTypeName()) {
                            echo '<option selected="selected">'. $value->getTypeName().'</option>';
                        }
                        else {
                            echo '<option>'. $value->getTypeName().'</option>';
                        }
                    }
                    echo '</select></div></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 190px">'.$items->getBrandName().'</span>
                            <select class="gridder_input select" style="width: 190px" name="'.encrypt("brandId|".$items->getId()."|".$items->getBrandId()).'">';
                    foreach($brands as $value){
                        if($items->getBrandName() == $value->getBrandName()) {
                            echo '<option selected="selected">'. $value->getBrandName().'</option>';
                        }
                        else {
                            echo '<option>'. $value->getBrandName().'</option>';
                        }
                    }
                    echo '</select></div></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 190px">'.$items->getModel().'</span>
                            <input type="text" class="gridder_input" style="width: 190px" name="'.encrypt("model|".$items->getId()).'" value="'.$items->getModel().'"></div></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 260px">'.$items->getSerialNumber().'</span>
                            <input type="text" class="gridder_input" style="width: 260px" name="'.encrypt("serialNumber|".$items->getId()).'" value="'.$items->getSerialNumber().'"></div></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 100px">'.$items->getProductionYear().'</span>
                            <input type="text" class="gridder_input" style="width: 100px" name="'.encrypt("productionYear|".$items->getId()).'" value="'.$items->getProductionYear().'"></div></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 100px">'.$items->getLifeSpan().'</span>
                            <input type="text" class="gridder_input" style="width: 100px" name="'.encrypt("lifespan|".$items->getId()).'" value="'.$items->getLifeSpan().'"></div></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 105px">'.$items->getEfficiencyClassName().'</span>
                            <select class="gridder_input select" style="width: 105px" name="'.encrypt("efficiencyClassId|".$items->getId()."|".$items->getEfficiencyClassId()).'">';
                    foreach($efficiencyClasses as $value){
                        if($items->getEfficiencyClassName() == $value->getClassName()) {
                            echo '<option selected="selected">'. $value->getClassName().'</option>';
                        }
                        else {
                            echo '<option>'. $value->getClassName().'</option>';
                        }
                    }
                    echo '</select></div></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 100px">'.$items->getEnergyPrice().'</span>
                            <input type="text" class="gridder_input" style="width: 100px" name="'.encrypt("energyPrice|".$items->getId()).'" value="'.$items->getEnergyPrice().'"></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 100px">'.$items->getEnergyConsumption().'</span>
                            <input type="text" class="gridder_input" style="width: 100px" name="'.encrypt("energyConsumption|".$items->getId()).'" value="'.$items->getEnergyConsumption().'"></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 100px">'.$items->getPrice().'</span>
                            <input type="text" class="gridder_input" style="width: 100px" name="'.encrypt("price|".$items->getId()).'" value="'.$items->getPrice().'"></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 800px">'.$items->getImage().'</span>
                            <input type="text" class="gridder_input" style="width: 800px" name="'.encrypt("image|".$items->getId()).'" value="'.$items->getImage().'"></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 310px">'.$items->getManufacturerLink().'</span>
                            <input type="text" class="gridder_input" style="width: 310px" name="'.encrypt("manufacturerLink|".$items->getId()).'" value="'.$items->getManufacturerLink().'"></td>';
                    echo '<td><div class="grid_content editable"><span style="width: 230px">'.$items->getShopLink().'</span>
                            <input type="text" class="gridder_input" style="width: 230px" name="'.encrypt("shopLink|".$items->getId()).'" value="'.$items->getShopLink().'"></td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>


