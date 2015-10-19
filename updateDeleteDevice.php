<?php
include_once 'headerAdmin.inc';
require_once 'database/class.Model.php';
require_once 'dto/class.Device.php';

$model = new Model();
$types = $model->getAllTypes();
$brands = $model->getAllBrands();
$efficiencyClasses = $model->getAllEfficiencyClasses();
$consumptions = array();
$showedItems = $model->getAllBrands();
$allItemsObjects = $model->getAllDevices();

function deleteDevice()
{

}

function updateDevice()
{

}

?>

<div class="">
    </br>
        <div class="box">

            <div class="box-head">
                <h2 class="left">All Devices</h2>
            </div>

            <div class="table">
                <div class="searchBarAdmin">
                    <input id="searchBar" type="text" name="searchBar" placeholder="Search a product..." class="ui-autocomplete-input" autocomplete="off">
                    <input type="submit" id="searchButton" value="search"/>
                </div>

                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <th width="13"><input type="checkbox" class="checkbox"></th>
                        <th id="selectAll"/>Select all</th>

                        <h1>FILTERS</h1>
                        </br>
                        <select name="selectType"style="width: 200px">
                            <?php
                            foreach($types as $value){
                                echo '<option>'.$value->getTypeName().'</option>';
                            } ?>
                        </select>


                        <select name="selectBrand" style="width: 200px">
                            <?php
                            foreach($brands as $value){
                                echo '<option>'. $value->getBrandName().'</option>';
                            } ?>
                        </select>


                        <select name="selectEfficiencyClassName" style="width: 200px">
                            <?php
                            foreach ($efficiencyClasses as $value) {
                                echo '<option>' . $value->getClassName() . '</option>';
                            } ?>
                        </select>
                    </tr>

                    <tr>
                        <th></th>
                        <th>Type</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Serial number</th>
                        <th>Production Year</th>
                        <th>Life Span (in years)</th>
                        <th>Efficiency class</th>
                        <th>Energy price (kWh/year)</th>
                        <th>Energy consumption</th>
                        <th>Price (in CHF)</th>
                        <th>Image URL</th>
                        <th>Manufacturer link</th>
                        <th>Shop link</th>
                        <th>Action</th>
                    </tr>



                    <tr>

                            <?php
                            foreach ($allItemsObjects as $items) {
                                echo'<td><input type="checkbox" class="checkbox"/>';

                                echo '<td>'. $items->getTypeName() . '</td>';
                                echo '<td>'. $items->getBrandName() . '</td>';
                                echo '<td>'. $items->getModel() . '</td>';
                                echo '<td>'. $items->getSerialNumber() . '</td>';
                                echo '<td>'. $items->getProductionYear() . '</td>';
                                echo '<td>'. $items->getLifeSpan() . '</td>';
                                echo '<td>'. $items->getEfficiencyClassName() . '</td>';
                                echo '<td>'. $items->getEnergyPrice() . '</td>';
                                echo '<td>'. $items->getEnergyConsumption() . '</td>';
                                echo '<td>'. $items->getPrice() . '</td>';
                                echo '<td>'. $items->getImage() . '</td>';
                                echo '<td>'. $items->getManufacturerLink() . '</td>';
                                echo '<td>'. $items->getShopLink() . '</td>';
                                echo '<td><a href="#" class="ico del">Delete</a>  <a href="#" class="ico edit">Edit</a> </td>';

                                echo'<tr>';

                            }

                            ?>

                    </tr>

                </table>



            </div>

        </div>
    </div>


