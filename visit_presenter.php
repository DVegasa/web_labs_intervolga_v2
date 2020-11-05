<?php

$result_OK = 0;
$result_errNotAuth = -1;

@session_start();

function addVisit($date, $time, $sumFrom, $curFrom, $curTo)
{
    require_once "db_users.php";
    global $result_OK;
    global $result_errNotAuth;

    $uid;
    try {
        $uid = getCurUserId();
    } catch (UserNotAuthed $ex) {
        header("location: log-in.php");
        return $result_errNotAuth;
    }
    
    
}

function getAllVisitsForCurrentUser() {
    require_once "db_visits.php";
    require_once "db_users.php";

    $uid;
    try {
        $uid = getCurUserId();
    } catch (UserNotAuthed $ex) {
        header("location: log-in.php");
        return $result_errNotAuth;
    }

    return getAllVisitsById($uid);
}
