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

    return addVisitDb($uid, $sumFrom, $curFrom, $curTo, $date, $time, 1);
}

function getAllVisitsForCurrentUser()
{
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

function statusByCode($status) {
    switch ($status){
        case 1: return "Запланирован";
        case 2: return "Идёт сейчас...";
        case 3: return "Завершён";
        case 4: return "Отменён";
        default: return "Неизвестен";
    }
}