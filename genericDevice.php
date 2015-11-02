<?php
include_once 'headerLogin.inc';

?>


<div class="loginBlock centered">
    <h1><?php $translate->__("Your generic device")?></h1>
    <form method="post" action="redirect.php">
        <select name="categoryDropdownlist">
            <?php $model->getDropdownlistCategory(); ?>
        </select>
        <input type="text" name="kwh" placeholder="Year" required />
        <input type="text" name="lifespan" placeholder="Resting lifespan" required />
        </br>
        </br>

        <button type="submit" value="Create your device" name="action"><?php $translate->__("Create")?></button>
        </br>
        </br>


        <!--
            if the user enter a wrong user password -> Message in red : Wrong Username or Password
            if the user enter a wrong username -> Message in red : User not found.
            -->

        <?php $reasons = array("password" => "Wrong Username or Password", "notfound" => "Username not found.");
        if (isset ( $_GET ['loginFailed'] )) {
            if ($_GET["loginFailed"]) {
                echo '<span style="color:red;">'.$reasons[$_GET["reason"]].'</span>';
            }
        }?>

    </form>
</div>
