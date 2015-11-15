<?php
include_once 'header/headerGlobal.inc';
if(!isset($_SESSION['myGenericDevice'])){
    $_SESSION['myGenericDevice'] = new Device();
}

$checker = true;
$generic = new Device();
//check if generic device already created
foreach($_SESSION['comparedDevices'] as $value){
    if($value->getSerialNumber() == 'MY-DEVICE'){
        $checker = false;
        $generic = $value;
    }
}

//create session for categories to display
if(!isset($_SESSION['categories'])){
    $_SESSION['categories'] = array();
}

//create generic device and refresh page
if(isset($_POST['createGenericDevice'])){
    $_SESSION['myGenericDevice']->setTypeId($_POST['categoryDropdownlist']);
    $_SESSION['myGenericDevice']->setEnergyConsumption($_POST['kwh']);
    $_SESSION['myGenericDevice']->setLifespan($_POST['lifespan']);
    $_SESSION['myGenericDevice']->setSerialNumber('MY-DEVICE');
    $_SESSION['myGenericDevice']->setImage('images/G.png');
    $name = 'GENERIC';
    $_SESSION['myGenericDevice']->setModel($name);
    array_push($_SESSION['comparedDevices'], $_SESSION['myGenericDevice']);
    echo '<meta http-equiv="refresh" content="0">';
}

//delete generic device and refresh page
if(isset($_POST['deleteGenericDevice'])){
    for($i = 0; $i < count($_SESSION['comparedDevices']); $i++){
        if($_SESSION['comparedDevices'][$i]->getSerialNumber() == 'MY-DEVICE'){
            unset($_SESSION['comparedDevices'][$i]);
            $_SESSION['comparedDevices'] = array_values($_SESSION['comparedDevices']);
            break;
        }
    }
    echo '<meta http-equiv="refresh" content="0">';
}

?>
<div class="loginBlock centered">
    <h1><?php $translate->__("Your generic device")?></h1>
    <form method="post" action="<?php
    echo $_SERVER['PHP_SELF'];
    echo $_SESSION['lang'];?>">
        <?php
        //if checker= true display form to create generic device
        if($checker){
            echo '<select id="categoryDropdownlist"name="categoryDropdownlist">';
            $_SESSION['categories'] = $controller->getDropdownlistCategory($translate);
            echo '</select>';
            echo '<input type="number" name="kwh" placeholder="';
            echo $translate->__('kW/h per year');
            echo '" required>';
            echo '<br />';
            echo '<br />';
            echo '<input type="number" name="lifespan" placeholder="';
            echo $translate->__('Resting lifespan per year');
            echo '" required>';
            echo '<br />';
            echo '<br />';
            echo '<button id="createGenericDevice" type="submit" value="Create your device" name="createGenericDevice">';
            echo $translate->__('Create');
            echo '</button>';
            echo '<br />';
            echo '<br />';
        }else{
            //if checker=false display already created generic device
            echo $translate->__('Category').' : ';
            foreach($_SESSION['categories'] as $categories){
                if($generic->getTypeId() == $categories->getId()){
                    echo $translate->__($categories->getTypeName());
                    break;
                }
            }
            echo '<br />';
            echo '<br />';
            echo $translate->__('Energy consumption').' : '.$generic->getEnergyConsumption();
            echo '<br />';
            echo '<br />';
            echo $translate->__('Resting lifespan per year').' : '.$generic->getLifeSpan();
            echo '<br />';
            echo '<br />';
            echo '<button id="deleteGenericDevice" type="submit" value="Delete your device" name="deleteGenericDevice">';
            echo $translate->__('Delete');
            echo '</button>';
        }

        ?>
    </form>
    <br />
    <br />
    <br />

    <!-- back button to return to index.php-->
    <form method="post" action="index.php">
        <button id="backGenericDevice" type="submit" value="back" name="back"><?php $translate->__("Back")?></button>
    </form>
</div>
