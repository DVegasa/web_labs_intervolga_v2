<!DOCTYPE html>
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
    <div class="begin">

        <form method="POST">
            <p>curFrom<br> 
            <input type="text" name="curFrom" /></p>

            <p>sumFrom<br> 
            <input type="text" name="sumFrom" /></p>
            
            <p>curTo<br> 
            <input type="text" name="curTo" /></p>

            <p>date<br> 
            <input type="text" name="date" /></p>

            <p>time<br> 
            <input type="text" name="time" /></p>

            <br><input type="submit" class="btn btn-primary" value="Выполнить">
        </form>

    ==================================== <br>
    <?php
        require_once "db_users.php";
        print_r(getUserIdByName("dvegasa"));
    ?>

    </div>
</body>

