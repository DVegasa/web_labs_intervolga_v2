
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="styles_ver.css">
        <title>ЛК. Только авторизованным</title>
    </head>
    <body>

        <?php
            session_start();
            if (!isset($_SESSION['username'])) {
                header('Location: auth.php');
            }
        ?>

        <div  class="title">
                <h1>Ваш личный кабинет</h1>
                <h3>Привет, <?php echo $_SESSION['username'] ?></h3>
            </div>

        <div class="form-item">
            <h1 class="title-2">Выход из аккаунта</h1>
            <form method="POST" action="logout.php" class="reg-form">
                <button type="submit" class="reg-form-item au-but">Выйти из аккаунта</button>
            </form>
        </div>


    </body>
</html>