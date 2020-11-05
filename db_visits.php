<?php

function getAllVisitsById($uid) {
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $mysqli = new mysqli($db_servername, $db_username, $db_password, "master");

    $username = $_SESSION['username'];
    $result = $mysqli->query("SELECT * FROM `visits` WHERE `userId` = '$uid'");
    return $result;
}