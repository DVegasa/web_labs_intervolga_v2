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

function addVisitDb($userId, $summaFrom, $curFrom, $curTo, $date, $time, $status) {
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $mysqli = new mysqli($db_servername, $db_username, $db_password, "master");

    $time = $time . ":00";
    $sql = 
        "INSERT INTO `visits` (`userId`, `summaFrom`, `curFrom`, `curTo`, `date`, `time`, `status`) VALUES "
        . "('$userId', $summaFrom, '$curFrom', '$curTo', '$date', '$time', $status)";

    if ($mysqli->query($sql) === TRUE) {
        return "New record created successfully";
    } else {
        return "Error: " . $sql . "<br>" . $mysqli->error;
    }
}