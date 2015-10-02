<?php
include_once 'headerAdmin.inc';

?>


<div class="loginBlock centered">
    <h1>Add a new article</h1>
    <form method="post" action="redirect.php">
        <input type="text" name="user" placeholder="Username" id="username" required /> </br></br>
        <input type="password" name="pwd" placeholder="Password" id="password" required />
        </br>
        </br>

        <button type="submit" value="login" name="action" >Login</button>
        </br>
        </br>

    </form>
</div>