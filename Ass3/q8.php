<?php

function RouteRandomPass($length) {

    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $password = "";

    for ($i = 0; $i < $length; $i++) {

        $random = random_int(0, strlen($characters) - 1);

        $password .= $characters[$random];
    }

    return $password;
}

echo RouteRandomPass(8);
?>