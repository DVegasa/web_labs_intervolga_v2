<?php

function isSecure_azAZ09($params) {
    foreach ($params as $string) {
        for ($i=0; $i < strlen($string); $i++) {
            $uppers = ($string[$i] >= 'A' && $string[$i] <= 'Z');
            $lowers = ($string[$i] >= 'a' && $string[$i] <= 'z');
            $numbers = ($string[$i] >= '0' && $string[$i] <= '9');

            if (!$uppers && !$lowers && !$numbers) {
                return false;
            }
        }  
    }
    return true;
}

?>