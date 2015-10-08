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
    $selectTypeName = $_POST['selectType'];
    $selectBrandName = $_POST['selectBrand'];
    $selectEfficiencyClassName = $_POST['selectEfficiencyClassName'];
    $selectProductionYear = $_POST['selectProductionYear'];

    $imageURL = $_POST['imageURL'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $energyPrice = $_POST['energyPrice'];
    $energyConsumption = $_POST['energyConsumption'];
    $serialNumber = $_POST['serialNumber'];
    $manufacturerLink = $_POST['manufacturerLink'];
    $shopLink = $_POST['shopLink'];

    echo($selectTypeName . " " . $selectBrandName . " " . $selectEfficiencyClassName . " " . $imageURL . " " . $model . " " . $price . " " .
        $energyPrice . " " . $energyConsumption . " " . $serialNumber . " " . $selectProductionYear . " " . $manufacturerLink . " " . $shopLink);

   // $this->model->createDevice($selectTypeName, $selectBrandName, $selectEfficiencyClassName, $imageURL, $model, $price, $energyPrice,
      //  $energyConsumption, $serialNumber, $selectProductionYear, $manufacturerLink, $shopLink);


}


?>


<div class="createNewArticleBlock centered" style="overflow: scroll">
    <h1>Add a new device</h1>
    <form method="post" action="addNewDevice_page.php"">

        Select a type
        <select name="selectType">
            <?php
            foreach($types as $value){
                echo '<option>'.$value.'</option>';
            } ?>
        </select>

        </br>

        Select a brand
        <select name="selectBrand">
            <?php
            foreach($brands as $value){
                echo '<option>'.$value.'</option>';
            } ?>
        </select>

        </br>

        Enter the model
        </br>
        <input type="text" name="model" required/>
        </br>

        Enter the serial number
        </br>

        <input type="text" name="serialNumber" required/>
        </br>


        Select the production year
        <select name="selectProductionYear">
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
        <textarea name="description"></textarea>
        </br>


        Select an efficiency class
        <select name="selectEfficiencyClassName">
            <?php
            foreach($efficiencyClasses as $value){
                echo '<option>'.$value.'</option>';
            } ?>
        </select>


        </br>


        Enter the energy price (kWh/year)
        </br>
        <input type="number" name="energyPrice" step="0.01" required/>
        </br>

        Enter the energy consumption (ex: 0.84)
        </br>
        <input type="number" name="energyConsumption" step="0.01" required/>
        </br>

        Enter the price (in CHF)
        </br>
        <input type="number" name="price" step="0.01" required/>
        </br>



        </br>
        <h2>LINKS</h2>
        </br>

        Enter the image URL
        </br>
        <input type="text" name="imageURL" required/>
        </br>

        Enter the manufacturer link
        </br>
        <input type="text" name="manufacturerLink" required/>
        </br>

        Enter the shop link
        </br>
        <input type="text" name="shopLink" required/>
        </br>



        <button type="submit" value="create" name="create">Create</button>
        </br>
        </br>




    </form>
</div>

</body>


