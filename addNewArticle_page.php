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

?>


<div class="createNewArticleBlock centered" xmlns="http://www.w3.org/1999/html">
    <h1>Add a new article</h1>
    <form method="post" action="createArticle.php">

        Select a type
        <select>
            <?php
            foreach($types as $value){
                echo '<option>'.$value.'</option>';
            } ?>
        </select>

        </br> </br>

        Select a brand
        <select>
            <?php
            foreach($brands as $value){
                echo '<option>'.$value.'</option>';
            } ?>
        </select>

        </br> </br>

        Choose a year
        <select>
            <option value="2006">2016</option>
            <option value="2005">2015</option>
            <option value="2004">2014</option>
            <option value="2003">2013</option>
            <option value="2002">2012</option>
            <option value="2001">2011</option>
            <option value="2000">2010</option>
        </select>

        </br> </br>

        Add a description
        </br>
        <textarea rows="4" cols="60"></textarea>


        </br> </br>


        Select an efficiency class
        <select>
            <?php
            foreach($efficiencyClasses as $value){
                echo '<option>'.$value.'</option>';
            } ?>
        </select>


        </br> </br>


        Select a consumption
        <select>
            <option value="2006">300W</option>
            <option value="2005">2015</option>
            <option value="2004">2014</option>
            <option value="2003">2013</option>
            <option value="2002">2012</option>
            <option value="2001">2011</option>
            <option value="2000">2010</option>
        </select>


        </br> </br>



        <button type="submit" value="create" name="action" >Create</button>
        </br>
        </br>

    </form>
</div>