<?php
if (
  isset($_POST['date']) &&
  isset($_POST['time']) &&
  isset($_POST['sumFrom']) &&
  isset($_POST['curFrom']) &&
  isset($_POST['curTo'])
) {
  require_once "get_visits.php";

  $filename = handleFile();
  if ($filename === '-1') {
    @header("Location: account.php?result=" . -2);
  }

  $result = addVisit(
    $_POST['date'],
    $_POST['time'],
    $_POST['sumFrom'],
    $_POST['curFrom'],
    $_POST['curTo'],
    $filename
  );

  @header("Location: account.php?result=" . $result);
} else {
  @header("Location: account.php");
}

function addVisit($date, $time, $sumFrom, $curFrom, $curTo, $filename)
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

  return addVisitDb($uid, $sumFrom, $curFrom, $curTo, $date, $time, 1, $filename);
}



function handleFile() {
  $FILESTORAGE = "files\\storage\\";
  if (!empty($_FILES['userfile']) ?? $_FILES['error'] === UPLOAD_ERR_OK) {
    require_once "db_users.php";

    $f = $_FILES['userfile'];
    $parts = pathinfo($f['name']);
    
    $name = "uid" . getCurUserId() . "_" . time() . "_" . rand(1000, 9999) 
                                                                    . "." . $parts['extension'];

    $success = move_uploaded_file($f['tmp_name'], $FILESTORAGE . $name);

    if (!$success) {
      return '-1';
    }
    chmod($FILESTORAGE . $name, 0644);
    return $name;
  }
}
