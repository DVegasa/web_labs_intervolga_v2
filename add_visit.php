<?php
  if (
    isset($_POST['date']) &&
    isset($_POST['time']) &&
    isset($_POST['sumFrom']) &&
    isset($_POST['curFrom']) &&
    isset($_POST['curTo'])
  ) {
    require_once "visit_presenter.php";
    
    $result = addVisit(
      $_POST['date'],
      $_POST['time'],
      $_POST['sumFrom'],
      $_POST['curFrom'],
      $_POST['curTo']
    );
    
    @header("Location: account.php?result=" . $result); 

  }

function addVisit($date, $time, $sumFrom, $curFrom, $curTo)
{
    require_once "db_users.php";
    require_once "db_visits.php";
    global $result_OK;
    global $result_errNotAuth;

    $uid;
    try {
        $uid = getCurUserId();
    } catch (UserNotAuthed $ex) {
        header("location: log-in.php");
    }

    return addVisitDb($uid, $sumFrom, $curFrom, $curTo, $date, $time, 1);
}