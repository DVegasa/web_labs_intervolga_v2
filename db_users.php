<?php
class UserNotAuthed extends Exception
{
}

@session_start();
function getCurUserId()
{
    if (!isset($_SESSION['username'])) throw new UserNotAuthed();

    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $mysqli = new mysqli($db_servername, $db_username, $db_password, "master");

    $username = $_SESSION['username'];
    
    // Данный запрос уже безопасен, т.к. $uid берётся из $_SESSION[]
    $result = $mysqli->query("SELECT (`id`) FROM `users` WHERE `username` = '$username'");

    $row = $result->fetch_assoc();
    return $row['id'];
}
