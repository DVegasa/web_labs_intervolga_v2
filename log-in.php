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
      if(isset($_SESSION['username'])){
          header("location: account.php");
      }
  ?>

  <nav class="navbar navbar-light navbar-expand-md navigation-clean-button"
    style="background: rgb(103,16,94);max-height: 59px;">
    <div class="container"><a class="navbar-brand" href="index.html"
        style="color: rgb(255,255,255);">MoneyBro</a><button data-toggle="collapse" class="navbar-toggler"
        data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span
          class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navcol-1">
        <ul class="nav navbar-nav mr-auto">
          <li class="nav-item"><a class="nav-link" href="exchanges.html"
              style="color: rgb(255,255,255);margin-left: 0px;">Текущий курс</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="blog.html" style="color: rgb(255,255,255);">Блог</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <form method="POST" action="doauth.php" class="form-signin">
    <div class="text-center mb-4">
      <h1 class="h3 mb-3 font-weight-normal">Войдите в свой аккаунт</h1>
    </div>

    <div class="form-label-group">
      <input type="login" name="login" id="login" class="form-control" placeholder="Логин" required="" autofocus="">
    </div>

    <div class="form-label-group">
      <input type="password" name="pass" id="pass" class="form-control" placeholder="Пароль" required="">
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
  </form>


</body>