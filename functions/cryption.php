<?php
// Function for encryption
function encrypt($data) {
    return base64_encode(base64_encode(base64_encode(strrev($data))));
}

// Function for decryption
function decrypt($data) {
    return strrev(base64_decode(base64_decode(base64_decode($data))));
}

?>