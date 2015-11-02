<?php
include_once 'headerLogin.inc';
if(!isset($_SESSION['myGenericDevice'])){
    $_SESSION['myGenericDevice'] = new Device();
}

?>


<div class="loginBlock centered">
    <h1><?php $translate->__("Your generic device")?></h1>
    <form method="post" action="genericDevice.php">
        <select name="categoryDropdownlist">
            <?php $model->getDropdownlistCategory(); ?>
        </select>
        <input type="number" name="kwh" placeholder="kW/h per year" required />
        </br>
        </br>
        <input type="number" name="lifespan" placeholder="Resting lifespan" required />
        </br>
        </br>

        <button type="submit" value="Create your device" name="createGenericDevice"><?php $translate->__("Create")?></button>
        </br>
        </br>


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

        if(isset($_POST['createGenericDevice'])){
            $_SESSION['myGenericDevice']->setTypeId($_POST['categoryDropdownlist']);
            $_SESSION['myGenericDevice']->setEnergyConsumption($_POST['kwh']);
            $_SESSION['myGenericDevice']->setLifespan($_POST['lifespan']);
            var_dump($_SESSION['myGenericDevice']);
        }

        ?>
    </form>
</div>
