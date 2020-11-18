<?php
if (
    isset($_GET['id']) 
) {

    require_once "db_users.php";
    require_once "db_visits.php";

    if (isIdsMatch($_GET['id'], getCurUserId())) {
        deleteVisit($_GET['id']);
        $result = 10;
    } else {
        $result = 11;
    }

    @header("Location: account.php?result=" . $result);
}
