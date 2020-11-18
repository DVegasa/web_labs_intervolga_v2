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

function getVisitById($id)
{
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $mysqli = new mysqli($db_servername, $db_username, $db_password, "master");

    $username = $_SESSION['username'];

    $sql = "SELECT * FROM `visits` WHERE `id` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function isIdsMatch($visitId, $userId)
{
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $mysqli = new mysqli($db_servername, $db_username, $db_password, "master");

    $sql = "SELECT * FROM `visits` WHERE `userId` = ? AND `id` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ii', $userId, $visitId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_array() !== null;
}

function deleteVisit($id) {
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $mysqli = new mysqli($db_servername, $db_username, $db_password, "master");

    $sql = "DELETE FROM `visits` WHERE `id` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
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
