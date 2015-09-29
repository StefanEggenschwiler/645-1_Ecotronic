<?php
include_once 'header.inc';
include_once 'footer.inc';
?>


<div class="loginBlock centered">
    <h1>Admin Login</h1>
    <form method="post" action="AdminPanel.php">
        <input type="text" name="user" placeholder="Username" id="username" /> </br></br>
        <input type="password" name="pwd" placeholder="Password" id="password" />
        </br>
        </br>
        <button type="submit" value="login" name="action">Login</button>
    </form>
</div>