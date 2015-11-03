<?php
include_once 'headerLogin.inc';
if(!isset($_SESSION['myGenericDevice'])){
    $_SESSION['myGenericDevice'] = new Device();
}

$checker = true;
$generic = new Device();
foreach($_SESSION['comparedDevices'] as $value){
    if($value->getSerialNumber() == 'MY-DEVICE'){
        $checker = false;
        $generic = $value;
    }
}



if(isset($_POST['createGenericDevice'])){
    $_SESSION['myGenericDevice']->setTypeId($_POST['categoryDropdownlist']);
    $_SESSION['myGenericDevice']->setEnergyConsumption($_POST['kwh']);
    $_SESSION['myGenericDevice']->setLifespan($_POST['lifespan']);
    $_SESSION['myGenericDevice']->setSerialNumber('MY-DEVICE');
    $_SESSION['myGenericDevice']->setImage('images/G.png');
    $name = 'GENERIC';
    $_SESSION['myGenericDevice']->setModel($name);
    array_push($_SESSION['comparedDevices'], $_SESSION['myGenericDevice']);
    $model->redirectToIndex('genericDevice');
}

if(isset($_POST['deleteGenericDevice'])){
    for($i = 0; $i < count($_SESSION['comparedDevices']); $i++){
        if($_SESSION['comparedDevices'][$i]->getSerialNumber() == 'MY-DEVICE'){
            unset($_SESSION['comparedDevices'][$i]);
            $_SESSION['comparedDevices'] = array_values($_SESSION['comparedDevices']);
            break;
        }
    }
    $model->redirectToIndex('genericDevice');
}

?>

<div class="loginBlock centered">
    <h1><?php $translate->__("Your generic device")?></h1>
    <form method="post" action="<?php
    echo $_SERVER['PHP_SELF'];
    echo $_SESSION['lang'];?>">
        <?php
        if($checker){
            echo '<select name="categoryDropdownlist">';
            $model->getDropdownlistCategory();
            echo '</select>';
            echo '<input type="number" name="kwh" placeholder="kW/h per year" required />';
            echo '</br>';
            echo '</br>';
            echo '<input type="number" name="lifespan" placeholder="Resting lifespan" required />';
            echo '</br>';
            echo '</br>';
            echo '<button type="submit" value="Create your device" name="createGenericDevice">';
            echo $translate->__("Create");
            echo '</button>';
            echo '</br>';
            echo '</br>';
        }else{
            echo 'Category'.' : '.$generic->getTypeId();
            echo '</br>';
            echo '</br>';
            echo 'Energy consumption'.' : '.$generic->getEnergyConsumption();
            echo '</br>';
            echo '</br>';
            echo 'Lifespan'.' : '.$generic->getLifeSpan();
            echo '</br>';
            echo '</br>';
            echo '<button type="submit" value="Delete your device" name="deleteGenericDevice">';
            echo $translate->__("Delete");
            echo '</button>';
        }

        ?>
    </form>
    </br>
    </br>
    </br>

    <form method="post" action="index.php">
        <button type="submit" value="Create your device" name="createGenericDevice"><?php $translate->__("Back")?></button>
    </form>

    <!--
        if the user enter a wrong user password -> Message in red : Wrong Username or Password
        if the user enter a wrong username -> Message in red : User not found.
        -->

    <?php
    $reasons = array("password" => "Wrong Username or Password", "notfound" => "Username not found.");
    if (isset ( $_GET ['loginFailed'] )) {
        if ($_GET["loginFailed"]) {
            echo '<span style="color:red;">'.$reasons[$_GET["reason"]].'</span>';
        }
    }

    ?>
</div>
