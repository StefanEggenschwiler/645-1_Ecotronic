<?php
include_once 'headerAdmin.inc';
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
var_dump($_POST);
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

function deleteDevice()
{

}

function updateDevice()
{

}
?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#selectAll").change(function(){
            $(".checkbox").prop('checked', $(this).prop("checked"));
        });
    });

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
                    <th width="13"><input type="checkbox" id="selectAll" ></th>
                    <th/>Select all</th>

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

                        <?php echo 'Result of you research : '. count($currentItemsArray) .' device(s).'; ?>

                        <h2><a href="#" id="deleteSelected">Delete selected devices</a></h2></br>
                    </form>
                </tr>
            </table>
            <form name="table" method="post">
                <div id="saveChanges">
                    <input type="submit" name="saveChanges" id="saveButton" value="Save changes"/>
                </div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <th></th>
                        <th>Action</th>
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

                    <tr>
                        <?php
                        foreach ($itemsFiltered as $items) {
                            echo '<td><input type="checkbox" name="check" class="checkbox"/>';
                            echo '<td><input type="submit" id="deleteItem" name="deleteItem" value="Delete"/></td>';
                            echo '<td style="display:none;"><input type="hidden" name="deviceId" value="'.$items->getId().'"></td>';
                            echo '<td style="display:none;"><input type="hidden" name="typeId" value="'.$items->getTypeId().'"></td>';
                            echo '<td style="display:none;"><input type="hidden" name="efficiencyClassId" value="'.$items->getEfficiencyClassId().'"></td>';
                            echo '<td style="display:none;"><input type="hidden" name="brandId" value="'.$items->getBrandId().'"></td>';
                            echo '<td><select style="width: 170px" name="typeName">';
                            foreach($types as $value){
                                if($items->getTypeName() == $value->getTypeName()) {
                                    echo '<option selected="selected">'. $value->getTypeName().'</option>';
                                }
                                else {
                                    echo '<option>'. $value->getTypeName().'</option>';
                                }
                            }
                            echo '</select></td>';
                            echo '<td><select style="width: 210px" name="brandName">';
                            foreach($brands as $value){
                                if($items->getBrandName() == $value->getBrandName()) {
                                    echo '<option selected="selected">'. $value->getBrandName().'</option>';
                                }
                                else {
                                    echo '<option>'. $value->getBrandName().'</option>';
                                }
                            }
                            echo '</select></td>';
                            echo '<td><input type="text" name="model" value="'.$items->getModel().'"></td>';
                            echo '<td><input type="text" name="serialNumber" value="'.$items->getSerialNumber().'"></td>';
                            echo '<td><input type="text" name="productionYear" value="'.$items->getProductionYear().'"></td>';
                            echo '<td><input type="text" name="lifeSpan" value="'.$items->getLifeSpan().'"></td>';
                            echo '<td><select style="width: 105px" name="efficiencyClassName">';
                            foreach($efficiencyClasses as $value){
                                if($items->getEfficiencyClassName() == $value->getClassName()) {
                                    echo '<option selected="selected">'. $value->getClassName().'</option>';
                                }
                                else {
                                    echo '<option>'. $value->getClassName().'</option>';
                                }
                            }
                            echo '</select></td>';
                            echo '<td><input type="text" name="energyPrice" value="'.$items->getEnergyPrice().'"></td>';
                            echo '<td><input type="text" name="energyConsumption" value="'.$items->getEnergyConsumption().'"></td>';
                            echo '<td><input type="text" name="price" value="'.$items->getPrice().'"></td>';
                            echo '<td><input type="text" name="image" value="'.$items->getImage().'"></td>';
                            echo '<td><input type="text" name="manufacturerLink" value="'.$items->getManufacturerLink().'"></td>';
                            echo '<td><input type="text" name="shopLink" value="'.$items->getShopLink().'"></td>';
                            echo'<tr>';
                        }
                        ?>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>


