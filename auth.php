<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="styles_ver.css">
        <title>Форма авторизации</title>
    </head>

    <body>
        <?php 
            session_start();
            if(isset($_SESSION['username'])){
                header("location: account.php");
            }
        ?>

        <div class="form-item">
            <h1 class="title-2">Форма авторизации</h1>
            <form method="POST" action="doauth.php" class="reg-form">
                <input type="text" class="reg-form-item" name="login" id="login" placeholder="Введите логин"> <br /> <br />
                <input type="password" class="reg-form-item" name="pass" id="pass" placeholder="Введите пароль"> <br /> <br />
                <button type="submit" class="reg-form-item au-but">Войти!</button>
            </form>
        </div>

    </body>
</html>