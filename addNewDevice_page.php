<?php
include_once 'headerAdmin.inc';
require_once 'database/class.Model.php';
require_once 'dto/class.Type.php';
require_once 'dto/class.Brand.php';
require_once 'dto/class.Device.php';
require_once 'dto/class.EfficiencyClass.php';

$model = new Model();
$types = $model->getTypes();
$brands = $model->getBrands();
$efficiencyClasses = $model->getEfficiencyClasses();
$consumptions = array();
$showedItems = $model->getBrands();


function createNewDevice() {
    $this->model->createDevice($typeid, $brandid, $efficiencyClassId, $imageURL, $model, $price, $energyPrice,
        $energyConsumption, $serialNumber, $productionYear, $manufacturerLink, $shopLink);
}


?>


<div class="createNewArticleBlock centered" style="overflow: scroll" xmlns="http://www.w3.org/1999/html">
    <h1>Add a new device</h1>
    <form method="post" action="addNewDevice_page.php">

        Select a type
        <select>
            <?php
            foreach($types as $value){
                echo '<option>'.$value.'</option>';
            } ?>
        </select>

        </br>

        Select a brand
        <select>
            <?php
            foreach($brands as $value){
                echo '<option>'.$value.'</option>';
            } ?>
        </select>

        </br>

        Enter the model
        </br>

        <input type="text" name="model" id="model" required/>
        </br>

        Enter the serial number
        </br>

        <input type="text" name="serialnumber" id="serialnumber" required/>
        </br>


        Select the production year
        <select>
            <option value="2006">2016</option>
            <option value="2005">2015</option>
            <option value="2004">2014</option>
            <option value="2003">2013</option>
            <option value="2002">2012</option>
            <option value="2001">2011</option>
            <option value="2000">2010</option>
        </select>

        </br>

        Add a short description
        </br>
        <textarea></textarea>
        </br>


        Select an efficiency class
        <select>
            <?php
            foreach($efficiencyClasses as $value){
                echo '<option>'.$value.'</option>';
            } ?>
        </select>


        </br>


        Enter the energy price (kWh/year)
        </br>
        <input type="number" name="energyprice" id="energyprice" required/>
        </br>

        Enter the energy consumption (ex: 0.84)
        </br>
        <input type="number" name="energyconsumption" id="energyconsumption" required/>
        </br>

        Enter the price
        </br>
        <input type="number" name="price" id="price" required/>
        </br>



        </br>
        <h2>LINKS</h2>
        </br>

        Enter the image URL
        </br>
        <input type="text" name="imageURL" id="imageURL" required/>
        </br>

        Enter the manufacturer link
        </br>
        <input type="text" name="manufacturerLink" id="manufacturerLink" required/>
        </br>

        Enter the shop link
        </br>
        <input type="text" name="shoplink" id="shoplink" required/>
        </br>



        <button type="submit" value="create" name="create">Create</button>
        </br>
        </br>




    </form>
</div>

</body>


