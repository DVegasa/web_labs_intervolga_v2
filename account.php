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

  <?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header('Location: log-in.php');
  }
  ?>

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
  $servername = "localhost";
  $username = "root";
  $password = "";
  $mysqli = new mysqli($servername, $username, $password, "master");
  $uname = $_SESSION['username'];

  $result = $mysqli->query("SELECT * FROM `users` WHERE `username` = '$uname'");

  $row = $result->fetch_assoc();
  ?>

  <div class="cabinet">
    <div class="cabinet_img">
      <img src="<?php echo $row['ava_url']; ?>" width="180px">
    </div>
    <div class="cabinet_info">
      <p class="name"> <strong><?php echo $row['first_name']; ?> </strong> </p>
      <p class="name"> <strong><?php echo $row['last_name']; ?> </strong> </p>
      <p class="LONE"> Секретный ключ: <?php echo $row['secret']; ?> </p>
      <p class="LTWO"> Роль в системе: <?php echo $row['role']; ?> </p>
    </div>

    </br>
    <div class="form-item">
      <form method="POST" action="logout.php" class="reg-form">
        <button type="submit" class="reg-form-item au-but">Выйти из аккаунта </button>

      </form>
    </div>
    <p>&nbsp;</p>
    <table id="Table1">


      <?php
      require_once "get_visits.php";
      $visits = getAllVisitsForCurrentUser();
      $v = $visits->fetch_assoc();

      if ($v === NULL) {
        echo "Запланированные визиты отсутствуют<br><br>";
      } else {
        echo '
        <tr>
        <td class="cell0">
          <p>&nbsp;&nbsp;&nbsp;Дата&nbsp;&nbsp;&nbsp;</p>
        </td>
        <td class="cell0">
          <p>&nbsp;&nbsp;&nbsp;Сумма к обмену&nbsp;&nbsp;&nbsp;</p>
        </td>
        <td class="cell0">
          <p>&nbsp;&nbsp;&nbsp;Исходная валюта&nbsp;&nbsp;&nbsp;</p>
        </td>
        <td class="cell0">
          <p>&nbsp;&nbsp;&nbsp;Перевод в&nbsp;&nbsp;&nbsp;</p>
        </td>
        <td class="cell0">
          <p>&nbsp;&nbsp;&nbsp;Статус&nbsp;&nbsp;&nbsp;</p>
        </td>
      </tr>
        ';
      }

      if (isset($_GET['result'])) {
        if ($_GET['result'] == 0) echo "Визит запланирован!";
        if ($_GET['result'] != 0) echo "Произошла ошибка. Повторите запрос";
      }

      while ($v !== NULL) {
        $date = $v['date'];
        $time = $v['time'];
        $summaFrom = $v['summaFrom'];
        $curFrom = $v['curFrom'];
        $curTo = $v['curTo'];
        $status = statusByCode($v['status']);

        echo '
          <tr>
          <td class="cell0">
            <p>' . $date . ' ' . $time . '</p>
          </td>
          <td class="cell0">
            <p>' . $summaFrom . '</p>
          </td>
          <td class="cell0">
            <p>' . $curFrom . '</p>
          </td>
          <td class="cell0">
            <p>' . $curTo . '</p>
          </td>
          <td class="cell0">
            <p>' . $status . '</p>
          </td>
      </tr>
        ';
        $v = $visits->fetch_assoc();
      }
      ?>
    </table>
  </div>

  <form id="form_viz" name="form1" method="POST" action="add_visit.php">
    <br>
    <div id="form0">
      <h1>Запланируйте визит</h1>
      <br>
      <label>Веберите дату визита</label>
      <input type="date" name="date" id="date1" required>
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
      <select name="curFrom" size="1">
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
      <button id="bt" type="submit">Запланировать</button>
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