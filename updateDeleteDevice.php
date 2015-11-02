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

$selectedCategoryChoice = null;
$selectedBrandChoice = null;
$selectedEfficiencyClassChoice = null;
var_dump($_POST);
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

            <div id="saveChanges">
                <input type="submit" name="saveChanges" id="searchButton" value="Save changes"/>
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
                        echo '<form name="row" method="post">';
                        echo '<td><input type="checkbox" name="check" class="checkbox"/>';
                        echo '<td><input type="submit" id="deleteItem" name="deleteItem" value="Delete"/></td>';
                        echo '<td style="display:none;" name="deviceId">'.   $items->getId().'</td>';
                        echo '<td style="display:none;" name="typeId">'.   $items->getTypeId().'</td>';
                        echo '<td style="display:none;" name="efficiencyClassId">'.   $items->getEfficiencyClassId().'</td>';
                        echo '<td style="display:none;" name="brandId">'.   $items->getBrandId().'</td>';
                        echo '<td contenteditable="true">'. $items->getTypeName() . '</td>';
                        echo '<td contenteditable="true">'. $items->getBrandName() . '</td>';
                        echo '<td contenteditable="true">'. $items->getModel() . '</td>';
                        echo '<td contenteditable="true">'. $items->getSerialNumber() . '</td>';
                        echo '<td contenteditable="true">'. $items->getProductionYear() . '</td>';
                        echo '<td contenteditable="true">'. $items->getLifeSpan() . '</td>';
                        echo '<td contenteditable="true">'. $items->getEfficiencyClassName() . '</td>';
                        echo '<td contenteditable="true">'. $items->getEnergyPrice() . '</td>';
                        echo '<td contenteditable="true">'. $items->getEnergyConsumption() . '</td>';
                        echo '<td contenteditable="true">'. $items->getPrice() . '</td>';
                        echo '<td contenteditable="true">'. $items->getImage() . '</td>';
                        echo '<td contenteditable="true">'. $items->getManufacturerLink() . '</td>';
                        echo '<td contenteditable="true">'. $items->getShopLink() . '</td>';
                        echo '</form>';
                        echo'<tr>';
                    }
                    ?>



                </tr>

            </table>



        </div>

    </div>
</div>


