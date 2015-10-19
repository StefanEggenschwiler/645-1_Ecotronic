<?php
include_once 'headerAdmin.inc';
require_once 'database/class.Model.php';


$model = new Model();
$types = $model->getAllTypes();
$brands = $model->getAllBrands();
$efficiencyClasses = $model->getAllEfficiencyClasses();
$consumptions = array();
$showedItems = $model->getAllBrands();

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
                        <th width="13"><input type="checkbox" class="checkbox"/></th>
                        <th id="selectAll">Select all</th>

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
                    </tr>

                    <tr>
                        <th width="13"><input type="checkbox" class="checkbox"/></th>
                        <th>Type</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Serial number</th>
                        <th>Production Year</th>
                        <th>Efficiency class</th>
                        <th>Energy consumption</th>
                        <th>Price</th>
                        <th>Image URL</th>
                        <th>Manufacturer link</th>
                        <th>Shop link</th>
                        <th>Action</th>
                    </tr>


                    <tr>
                        <td><input type="checkbox" class="checkbox"/></td>
                        <td><h3>....</h3></td>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                        <td><a href="#" class="ico del">Delete</a>  <a href="#" class="ico edit">Edit</a></td>
                    </tr>

                </table>



            </div>

        </div>
    </div>


