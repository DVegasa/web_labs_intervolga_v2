<?php
    $users = array(
        "admin" => "admin",
        "dvegasa" => "123"
    );

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $error = "";
    for ($i=0; $i < strlen($login); $i++) {
        $uppers = ($login[$i] >= 'A' && $login[$i] <= 'Z');
        $lowers = ($login[$i] >= 'a' && $login[$i] <= 'z');
        $numbers = ($login[$i] >= '0' && $login[$i] <= '9');

        if (!$uppers && !$lowers && !$numbers) {
            $error =  "Недопустимые символы в логине";
        }
    }   

    for ($i=0; $i < strlen($pass); $i++) {
        $uppers = ($pass[$i] >= 'A' && $pass[$i] <= 'Z');
        $lowers = ($pass[$i] >= 'a' && $pass[$i] <= 'z');
        $numbers = ($pass[$i] >= '0' && $pass[$i] <= '9');

        if (!$uppers && !$lowers && !$numbers) {
            $error =  "Недопустимые символы в пароле";
        }
    }  

    if ($error === "" ) {
        if (isset($users[$login])) {
            if ($users[$login] === $pass) {
                session_start();
                $_SESSION['username']=$login;
                header("location: account.php");

            } else {
                $error =  "Неверный пароль";
            }
        } else {
            $error =  "Такой логин не зареган";
        }
    }
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>volsu_bootstrapp</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="center">
	<img src="assets/img/error.png" width="180px">
   <h3 align="center"><?php echo $error; ?> </h3>
   <span class="back"> <a class="btn btn-light action-button" role="button" href="log-in.php" style="background: rgb(239,239,239);border-radius: 11px;color: rgb(0,0,0);font-weight: bold;text-align: center">Вернуться к авторизации</a></span>
</div>
</body>