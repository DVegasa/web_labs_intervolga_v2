<?php

function getAllVisitsById($uid)
{
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $mysqli = new mysqli($db_servername, $db_username, $db_password, "master");

    $username = $_SESSION['username'];
    
    // Данный запрос уже безопасен, т.к. $uid берётся из $_SESSION[]
    $result = $mysqli->query("SELECT * FROM `visits` WHERE `userId` = '$uid'"); 
    return $result;
}

function addVisitDb($userId, $summaFrom, $curFrom, $curTo, $date, $time, $status)
{
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $mysqli = new mysqli($db_servername, $db_username, $db_password, "master");

    $time = $time . ":00";
    $sql =
        "INSERT INTO `visits` (`userId`, `summaFrom`, `curFrom`, `curTo`, `date`, `time`, `status`) VALUES "
        . "(?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('iissssi', $userId, $summaFrom, $curFrom, $curTo, $date, $time, $status);
    $stmt->execute();
    $result = $stmt->get_result();
    return 0;
}
