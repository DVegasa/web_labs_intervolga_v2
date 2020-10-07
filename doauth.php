<?php
    $users = array(
        "admin" => "admin",
        "dvegasa" => "123"
    );

    $login = $_POST['login'];
    $pass = $_POST['pass'];
    echo $login . ":";
    echo $pass;

    if (isset($users[$login])) {
        if ($users[$login] === $pass) {
            session_start();
            $_SESSION['username']=$login;
            header("location: account.php");

        } else {
            echo "Неверный пароль";
        }
    } else {
        echo "Такой логин не зареган";
    }
    return;


?>