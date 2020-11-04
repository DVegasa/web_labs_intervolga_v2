<?php

class UserNotAuthed extends Exception {}

session_start();

function isUserAuthed() {
    return (isset($_SESSION['username']));
}

function getCurrentUserId() {
    if (!isUserAuthed) throw new UserNotAuthed();
    require_once "db_users.php";
    return getUserIdByName(getUserName());
}

function getUserName() {
    if (!isUserAuthed) throw new UserNotAuthed();
    return strtolower($_SESSION['username']);
}

?>