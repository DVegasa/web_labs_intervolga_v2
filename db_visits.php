<?php

require_once "security.php";

class Visit {
    public $id, $userId, $sumFrom, $curFrom, $curTo, $date, $time, $status;
}

$STATUS_PLANNED = 1;
$STATUS_ONGOING = 2;
$STATUS_COMPLETED = 3;
$STATUS_CANCELLED = 4;

$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$mysqli = new mysqli($db_servername, $db_username, $db_password, "master");


function addVisit($visit) {
    if (!isSecure_azAZ09($username)) {
        $si = new SecurityIssue();
        $si->msg = "Username is not <azAZ09>";
        throw $si;
    }

    $result = $mysqli->query("SELECT (`id`) FROM `users` WHERE `username` = '$username'");
    
    $row = $result->fetch_assoc();
    return $row['id'];
}

function getAllVisitsForUser($userId) {

}



?>