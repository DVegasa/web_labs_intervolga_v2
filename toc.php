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
    <div> 
        <h2>Анкета</h2>
        <form method="POST">
            <p>Введите имя файла на сервере, без расширения файла<br> 
            <input type="text" name="html" /></p>
            <p>Максимальная вложенность: <br> 
                <input required type="radio" name="hLevel" value="1" />h1 </br>
                <input required type="radio" name="hLevel" value="2" />h2 </br>
                <input required type="radio" name="hLevel" value="3" />h3 </br>
                <input required type="radio" name="hLevel" value="4" />h4 </br>
                <input required type="radio" name="hLevel" value="5" />h5 </br>
                <input required checked type="radio" name="hLevel" value="6" />h6 </br>

            <p>Префикс для сгенерированных id. По умолчанию, toc<br> 
            <input required type="text" value="toc" name="idPreffix" /></p>

            <input type="submit" value="Выполнить">
        </form>

        <?php
            if (isset($_POST['html']) && isset($_POST['hLevel'])) {
                require_once "laba3.php";
                $tocConfig = new TocConfig;
                $tocConfig->name = $_POST['html'];
                $tocConfig->hLevel = $_POST['hLevel'];
                if (!isset($_POST['idPreffix']) || $_POST['idPreffix'] === "") {
                    $_POST['idPreffix'] = 'toc';
                }
                $tocConfig->idPreffix = $_POST['idPreffix'];
                $tocResult = getTocByResourceName($_POST['html'], $tocConfig);
                
                if ($tocResult instanceof TocResult) {
                    echo "Готовый TOC </br>";
                    echo htmlentities($tocResult->tocHtml);
                    echo "</br> </br> Обновлённый HTML </br> </br>";
                    echo htmlentities($tocResult->modifiedHtml);

                    echo "</br> </br> </br> </br>";
                    echo $tocResult->tocHtml;
                    echo $tocResult->modifiedHtml;
                    
                } else if ($tocResult instanceof ErrorResult) {
                    echo $tocResult->msg;
                }
                
            }
        ?>

    </div>
</body>