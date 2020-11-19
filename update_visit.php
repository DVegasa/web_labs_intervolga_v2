<?php
if (
    isset($_POST['id']) &&
    isset($_POST['date']) &&
    isset($_POST['time']) &&
    isset($_POST['sumFrom']) &&
    isset($_POST['curFrom']) &&
    isset($_POST['curTo'])
) {

    require_once "db_users.php";
    require_once "db_visits.php";

    if (!isIdsMatch($_GET['id'], getCurUserId())) {
        header('Location: account.php');
    }

    $result = updateVisit(
        $_POST['id'],
        $_POST['date'],
        $_POST['time'],
        $_POST['sumFrom'],
        $_POST['curFrom'],
        $_POST['curTo']
    );

    @header("Location: account.php?result=" . $result);
}

function updateVisit($id, $date, $time, $sumFrom, $curFrom, $curTo)
{
    require_once "db_users.php";
    require_once "db_visits.php";
    global $result_OK;
    global $result_errNotAuth;

    updateVisitDb($id, $sumFrom, $curFrom, $curTo, $date, $time, 1);
    return 20;
}
