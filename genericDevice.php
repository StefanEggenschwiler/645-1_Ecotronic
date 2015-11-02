<?php
include_once 'headerLogin.inc';
?>


<div class="loginBlock centered">
    <h1><?php $translate->__("")?></h1>
    <form method="post" action="redirect.php">
        <input type="text" name="user" placeholder="Username" required /> </br></br>
        <input type="text" name="pwd" placeholder="Password" required />
        </br>
        </br>

        <button type="submit" value="login" name="action"><?php $translate->__str("Create")?></button>
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
