<?php

require "security.php";

class UserNotFoundException extends Exception {};
class SecurityIssue extends Exception {};

function getUserIdByName($username) {
    if (!isSecure_azAZ09($username)) {
        $si = new SecurityIssue();
        $si->msg = "Username is not <azAZ09>";
        throw $si;
    }

    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $mysqli = new mysqli($db_servername, $db_username, $db_password, "master");

    $result = $mysqli->query("SELECT (`id`) FROM `users` WHERE `username` = '$username'");
    
    $row = $result->fetch_assoc();
    return $row['id'];
}

?>