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
</head>
<body>

        <?php
            session_start();
            if (!isset($_SESSION['username'])) {
                header('Location: log-in.php');
            }
        ?>

<nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background: rgb(103,16,94);max-height: 59px;">
        <div class="container"><a class="navbar-brand" href="index.html" style="color: rgb(255,255,255);">MoneyBro</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="exchanges.html" style="color: rgb(255,255,255);margin-left: 0px;">Текущий курс</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="blog.html" style="color: rgb(255,255,255);">Блог</a></li>
                </ul></div>
        </div>
    </nav>

  <tbody>
    <tr>
      <td><img id="avatar" src="assets/img/avatar.jpg"  alt=""/><table width="200" border="1"></td>
      <td><h1 align="center">Секрет: 

          <?php 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $mysqli = new mysqli($servername, $username, $password, "master");
            $uname = $_SESSION['username'];

            $result = $mysqli->query("SELECT * FROM `users`
                                      WHERE `username` = '$uname'");

            $row = $result->fetch_assoc();
            echo $row['secret'];
          ?>

      </h1></td>
    </tr>
    <tr>
      <td><label></label></td>
      <td><label></label></td>
    </tr>
  </tbody>
</table>

    <div class="form-item"> 
        <form method="POST" action="logout.php" class="reg-form">
            <button type="submit" class="reg-form-item au-but">Выйти из аккаунта</button>
        </form>
    </div>

</body>