<!DOCTYPE HTML>
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
    <style>
        body {
            background-image: url(assets/img/fon_akk.jpg);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background: rgb(103,16,94);max-height: 59px;">
        <div class="container"><a class="navbar-brand" href="index.php" style="color: rgb(255,255,255);">MoneyBro</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="exchanges.php" style="color: rgb(255,255,255);margin-left: 0px;">Текущий курс</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="blog.php" style="color: rgb(255,255,255);">Блог</a></li>
                </ul>
            </div>
            </ul>
        </div>
        </div>
    </nav>

    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: log-in.php');
    }

    if (!isset($_GET['id'])) {
        header('Location: account.php');
    }


    require_once "db_users.php";
    require_once "db_visits.php";

    if (!isIdsMatch($_GET['id'], getCurUserId())) {
        header('Location: account.php');
    }

    require_once "get_visits.php";
    $v = _getVisitById($_GET['id']);
    print_r($v);
    ?>


    <form id="form_viz" name="form1" method="POST" action="update_visit.php">
        <br>
        <div id="form0">
            <input type="hidden" name="id">
            <h1>Редактирование визита</h1>
            <br>
            <label>Веберите дату визита</label>
            <input type="date"  name="date" id="date1" required>
            <span class="validity"></span>
            <br>
            <label>Веберите время визита</label>
            <input type="time" name="time" required>
            <span class="validity"></span>
            <br>
            <br>
            <label>Введите сумму для перевода и валюту конвертации
                (точный курс будет известен во время визита)</label>
            <br>
            <input type="number" name="sumFrom" min="0" required>
            <span class="validity"></span>
            <select name="curFrom" default="EUR" size="1">
                <option>RUB</option>
                <option>USD</option>
                <option>EUR</option>
                <option>GBP</option>
                <option>JPY</option>
                <option>CHF</option>
                <option>CNY</option>
            </select>
            <label>--></label>
            <select name="curTo" size="1">
                <option>USD</option>
                <option>RUB</option>
                <option>EUR</option>
                <option>GBP</option>
                <option>JPY</option>
                <option>CHF</option>
                <option>CNY</option>
            </select>
            <br>
            <br>
            <button id="bt" type="submit">Сохранить</button>
        </div>
    </form>




    <script>
        function zero_first_format(value) {
            if (value < 10) {
                value = '0' + value;
            }
            return value;
        }

        function date_time() {
            var current_datetime = new Date();
            var day = zero_first_format(current_datetime.getDate());
            var month = zero_first_format(current_datetime.getMonth() + 1);
            var year = current_datetime.getFullYear();

            return year + "-" + month + "-" + day;
        }

        function date_time_max() {
            var current_datetime = new Date();
            var day = zero_first_format(current_datetime.getDate());
            var month = zero_first_format(current_datetime.getMonth() + 1);
            var year = current_datetime.getFullYear() + 1;

            return year + "-" + month + "-" + day;
        }
        document.getElementById('date1').min = date_time();
        document.getElementById('date1').max = date_time_max();
    </script>
</body>