<?php
include_once 'headerAdmin.inc';
require_once 'database/class.Model.php';
require_once 'dto/class.Device.php';

$model = new Model();
$types = $model->getAllTypes();
$brands = $model->getAllBrands();
$efficiencyClasses = $model->getAllEfficiencyClasses();
$consumptions = array();
$itemsFiltered;
$allItemsObjects = $model->getAllDevices();

$selectedCategoryChoice = null;
$selectedBrandChoice = null;
$selectedEfficiencyClassChoice = null;

if(isset($_POST['submit'])){
    $selectedCategoryChoice = $_POST['selectedType'];  // Storing Selected Value In Variable
    $selectedBrandChoice = $_POST['selectedBrand'];  // Storing Selected Value In Variable
    $selectedEfficiencyClassChoice = $_POST['selectedEfficiencyClass'];  // Storing Selected Value In Variable

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
</script>




<div class="">
    </br>
    <div class="box">

        <div class="box-head">
            <h2 class="left">Devices</h2>
        </div>

        <div class="table">
            <div class="searchBarAdmin">
                <input id="searchBar" type="text" name="searchBar" placeholder="Search a product..." class="ui-autocomplete-input" autocomplete="off">
                <input type="submit" id="searchButton" value="search"/>
            </div>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th width="13"><input type="checkbox" id="selectAll" ></th>
                    <th/>Select all</th>

                    <h1>FILTERS</h1>
                    </br>

                    <form action="#" method="post">

                        <select style="width: 200px" class="selectedType" name="selectedType" onchange="this.form.submit();">
                            <?php
                            echo '<option>Category</option>';
                            foreach($types as $value){
                                if(isset($_POST['selectedType']) && $_POST['selectedType'] == $value->getTypeName()) {
                                    echo '<option selected="selected">'. $value->getTypeName().'</option>';

                                }
                                else {
                                    echo '<option>'. $value->getTypeName().'</option>';

                                }
                            } ?>


                        </select>


                        <select style="width: 200px" name="selectedBrand" >
                            <?php
                            echo '<option>Brand</option>';
                            foreach($brands as $value){
                                if(isset($_POST['selectedBrand']) && $_POST['selectedBrand'] == $value->getBrandName()) {
                                    echo '<option selected="selected">'. $value->getBrandName().'</option>';

                                }
                                else {
                                    echo '<option>'. $value->getBrandName().'</option>';

                                }
                            } ?>
                        </select>


                        <select style="width: 200px" name="selectedEfficiencyClass" >
                            <?php
                            echo '<option>Efficiency Class</option>';
                            foreach ($efficiencyClasses as $value) {
                                if(isset($_POST['selectedEfficiencyClass']) && $_POST['selectedEfficiencyClass'] == $value->getClassName()) {
                                    echo '<option selected="selected">'. $value->getClassName().'</option>';

                                }
                                else {
                                    echo '<option>'. $value->getClassName().'</option>';

                                }
                            } ?>
                        </select>

                        <input type="submit" name="submit" value="Sort" />

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

                    if(isset($_POST['submit'])){
                        if($selectedCategoryChoice == 'Category') {
                            //DOESNT WORK YET!!!
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
                        $itemsFiltered = $model->getDevicesByFilter($selectedCategoryChoice, $filterBrand, $filterEfficiencyClass);
                    } else {
                        $itemsFiltered = $allItemsObjects;
                    }

                    foreach ($itemsFiltered as $items) {
                        echo'<td><input type="checkbox" name="check" class="checkbox"/>';

                        echo '<td><a href="#" class="ico del">Delete</a> </td>';

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

                        echo'<tr>';

                    }
                    ?>



                </tr>

            </table>



        </div>

    </div>
</div>


