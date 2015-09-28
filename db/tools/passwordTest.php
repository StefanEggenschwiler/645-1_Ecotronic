<?php
$hash = password_hash("12345", PASSWORD_BCRYPT);
echo $hash."<br>";

if (password_verify('12345', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}